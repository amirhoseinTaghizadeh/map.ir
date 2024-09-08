<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('user_id');
            $table->foreign("user_id")
                ->on("users")
                ->references("id");
            $table->timestamps();
        });

        DB::statement("ALTER TABLE posts ADD COLUMN searchtext TSVECTOR");
        DB::statement("UPDATE posts SET searchtext = to_tsvector('english', title || '' || description)");
        DB::statement("CREATE INDEX searchtext_gin ON posts USING GIN(searchtext)");
        DB::statement("CREATE TRIGGER ts_searchtext BEFORE INSERT OR UPDATE ON posts FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchtext', 'pg_catalog.english', 'title', 'description')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TRIGGER IF EXISTS tsvector_update_trigger ON posts");
        DB::statement("DROP INDEX IF EXISTS searchtext_gin");
        DB::statement("ALTER TABLE posts DROP COLUMN searchtext");
        Schema::dropIfExists('posts');
    }
};
