# SQLite Configuration for Wasmer

If you want to use SQLite instead of MySQL for Wasmer deployment:

## Step 1: Update your .env file
```
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite
```

## Step 2: Create SQLite database
Run this command to create the SQLite database:
```bash
touch database/database.sqlite
```

## Step 3: Update your database.php file
Replace the MySQL connection with SQLite:

```php
// Database configuration
if (getenv('DB_CONNECTION') === 'sqlite') {
    $dbPath = getenv('DB_DATABASE') ?: __DIR__ . '/../database/database.sqlite';
    $pdo = new PDO("sqlite:$dbPath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} else {
    // MySQL connection code
    $host = getenv('DB_HOST') ?: 'localhost';
    // ... rest of MySQL config
}
```

## Step 4: Run database migrations
Create a migration script to set up your SQLite tables:
```php
// create_tables.php
<?php
require_once 'includes/db.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql);
    echo "✅ SQLite database and tables created successfully!\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
```

## ⚠️ Limitations
- SQLite doesn't support all MySQL features
- Concurrent writes may be slower
- No user management features like MySQL
- File-based database (single file)

## ✅ Recommendation
Use Railway instead - it's easier and more reliable for production apps.
