<?php

return [
    'table_storage' => [
        'table_name' => 'doctrine_migration_versions',
        'version_column_name' => 'version',
        'version_column_length' => 191,
        'executed_at_column_name' => 'executed_at',
    ],
    'migrations_paths' => [
        'Infrastructure\Persistence\Migrations' => __DIR__ . '/../src/Infrastructure/Persistence/Migrations',
    ],
    'all_or_nothing' => true,
    'check_database_platform' => true,
];
