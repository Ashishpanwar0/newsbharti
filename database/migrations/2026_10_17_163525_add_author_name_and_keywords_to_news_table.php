
public function up(): void
{
    Schema::table('news', function (Blueprint $table) {
        $table->string('author_name')->nullable();
        $table->text('keywords')->nullable();
    });
}

public function down(): void
{
    Schema::table('news', function (Blueprint $table) {
        $table->dropColumn(['author_name', 'keywords']);
    });
}
