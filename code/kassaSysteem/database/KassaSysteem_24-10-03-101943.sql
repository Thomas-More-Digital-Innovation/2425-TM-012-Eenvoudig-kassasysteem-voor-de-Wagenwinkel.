PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "migrations" ("id" integer primary key autoincrement not null, "migration" varchar not null, "batch" integer not null);
INSERT INTO migrations VALUES(1,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO migrations VALUES(4,'2024_09_25_160718_add_two_factor_columns_to_users_table',1);
INSERT INTO migrations VALUES(5,'2024_09_25_160802_create_personal_access_tokens_table',1);
INSERT INTO migrations VALUES(6,'2024_10_02_112712_create_rollen_table',1);
INSERT INTO migrations VALUES(7,'2024_10_02_113004_create_user_ids_table',1);
INSERT INTO migrations VALUES(8,'2024_10_02_113725_create_organisaties_table',1);
INSERT INTO migrations VALUES(9,'2024_10_02_113751_create_instellingen_table',1);
INSERT INTO migrations VALUES(10,'2024_10_02_113805_create_wisselgelden_table',1);
INSERT INTO migrations VALUES(11,'2024_10_02_113817_create_muntstukken_table',1);
INSERT INTO migrations VALUES(12,'2024_10_02_113835_create_verkopen_table',1);
INSERT INTO migrations VALUES(13,'2024_10_02_115136_create_verkooplijnen_table',1);
INSERT INTO migrations VALUES(14,'2024_10_02_115153_create_producten_table',1);
INSERT INTO migrations VALUES(15,'2024_10_02_115208_create_categories_table',1);
INSERT INTO migrations VALUES(16,'2024_10_02_115224_create_standaard_producten_table',1);
CREATE TABLE IF NOT EXISTS "users" ("id" integer primary key autoincrement not null, "name" varchar not null, "email" varchar not null, "email_verified_at" datetime, "password" varchar not null, "remember_token" varchar, "current_team_id" integer, "profile_photo_path" varchar, "created_at" datetime, "updated_at" datetime, "two_factor_secret" text, "two_factor_recovery_codes" text, "two_factor_confirmed_at" datetime);
INSERT INTO users VALUES(1,'Test User','test@example.com','2024-10-03 08:02:36','$2y$12$NyRbThdRTrHSVqBSZOzapO3sD6lPhvYgMZcKZYviVuxwuMsH7rmk.','nr3hOZsJxZ',NULL,NULL,'2024-10-03 08:02:36','2024-10-03 08:02:36',NULL,NULL,NULL);
CREATE TABLE IF NOT EXISTS "password_reset_tokens" ("email" varchar not null, "token" varchar not null, "created_at" datetime, primary key ("email"));
CREATE TABLE IF NOT EXISTS "sessions" ("id" varchar not null, "user_id" integer, "ip_address" varchar, "user_agent" text, "payload" text not null, "last_activity" integer not null, primary key ("id"));
CREATE TABLE IF NOT EXISTS "cache" ("key" varchar not null, "value" text not null, "expiration" integer not null, primary key ("key"));
CREATE TABLE IF NOT EXISTS "cache_locks" ("key" varchar not null, "owner" varchar not null, "expiration" integer not null, primary key ("key"));
CREATE TABLE IF NOT EXISTS "jobs" ("id" integer primary key autoincrement not null, "queue" varchar not null, "payload" text not null, "attempts" integer not null, "reserved_at" integer, "available_at" integer not null, "created_at" integer not null);
CREATE TABLE IF NOT EXISTS "job_batches" ("id" varchar not null, "name" varchar not null, "total_jobs" integer not null, "pending_jobs" integer not null, "failed_jobs" integer not null, "failed_job_ids" text not null, "options" text, "cancelled_at" integer, "created_at" integer not null, "finished_at" integer, primary key ("id"));
CREATE TABLE IF NOT EXISTS "failed_jobs" ("id" integer primary key autoincrement not null, "uuid" varchar not null, "connection" text not null, "queue" text not null, "payload" text not null, "exception" text not null, "failed_at" datetime not null default CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS "personal_access_tokens" ("id" integer primary key autoincrement not null, "tokenable_type" varchar not null, "tokenable_id" integer not null, "name" varchar not null, "token" varchar not null, "abilities" text, "last_used_at" datetime, "expires_at" datetime, "created_at" datetime, "updated_at" datetime);
CREATE TABLE IF NOT EXISTS "rollen" ("rol_id" integer primary key autoincrement not null, "naam" varchar not null);
INSERT INTO rollen VALUES(1,'admin');
INSERT INTO rollen VALUES(2,'begeleider');
INSERT INTO rollen VALUES(3,'verkoper');
CREATE TABLE IF NOT EXISTS "user_ids" ("user_id" integer primary key autoincrement not null, "naam" varchar not null, "password" integer not null, "rol_id" integer not null, "organisatie_id" integer not null);
INSERT INTO user_ids VALUES(1,'Gebruiker1','$2y$12$wZ1lt2URI0fhDKR2Ip8C3uM77VH96k2pX9a5JZj5DOzYuGxXUZs8u',2,2);
INSERT INTO user_ids VALUES(2,'Gebruiker2','$2y$12$QoXb3Qn/yaEegh32q1c/weQIcXKSIrKUxlhKXJXc.vYdNuIYHlEwK',3,1);
INSERT INTO user_ids VALUES(3,'Gebruiker3','$2y$12$K5wDlq4BkLagx8Zj2cEZqOdNj68Z9rUF7f5Dxxmy5vDLPCKD85zLK',1,2);
CREATE TABLE IF NOT EXISTS "organisaties" ("organisatie_id" integer primary key autoincrement not null, "naam" varchar not null);
INSERT INTO organisaties VALUES(1,'organisatie 1');
INSERT INTO organisaties VALUES(2,'organisatie 2');
INSERT INTO organisaties VALUES(3,'organisatie 3');
CREATE TABLE IF NOT EXISTS "instellingen" ("instelling_id" integer primary key autoincrement not null, "instelling" varchar not null, "status" tinyint(1) not null default '0', "organisatie_id" integer not null);
INSERT INTO instellingen VALUES(1,'test Instelling 1',1,1);
INSERT INTO instellingen VALUES(2,'test Instelling 2 (default status)',0,2);
CREATE TABLE IF NOT EXISTS "wisselgelden" ("wisselgeld_id" integer primary key autoincrement not null, "datum" date not null, "hoeveelheid" integer not null, "organisatie_id" integer not null, "muntstuk_id" integer not null);
INSERT INTO wisselgelden VALUES(1,'2024-10-03',20,1,1);
INSERT INTO wisselgelden VALUES(2,'2024-10-03',35,2,2);
INSERT INTO wisselgelden VALUES(3,'2024-10-03',10,2,3);
CREATE TABLE IF NOT EXISTS "muntstukken" ("muntstuk_id" integer primary key autoincrement not null, "soort" float not null);
INSERT INTO muntstukken VALUES(1,0.2000000000000000111);
INSERT INTO muntstukken VALUES(2,0.1000000000000000055);
INSERT INTO muntstukken VALUES(3,10.0);
CREATE TABLE IF NOT EXISTS "verkopen" ("verkoop_id" integer primary key autoincrement not null, "datum_tijd" datetime not null, "organisatie_id" integer not null);
INSERT INTO verkopen VALUES(1,'2024-10-03 08:02:35',2);
INSERT INTO verkopen VALUES(2,'2024-10-03 08:02:35',1);
CREATE TABLE IF NOT EXISTS "verkooplijnen" ("verkooplijn_id" integer primary key autoincrement not null, "hoeveelheid" integer not null, "verkoopprijs" float not null, "verkoop_id" integer not null, "product_id" integer not null);
INSERT INTO verkooplijnen VALUES(1,5,5.5,1,1);
INSERT INTO verkooplijnen VALUES(2,8,6.5,1,2);
CREATE TABLE IF NOT EXISTS "producten" ("product_id" integer primary key autoincrement not null, "naam" varchar not null, "actuele_prijs" float, "afbeeldingen" varchar, "organisatie_id" integer not null, "categorie_id" integer not null, "standaard_id" integer not null);
INSERT INTO producten VALUES(1,'product 1',16.5,'test.png',1,2,1);
INSERT INTO producten VALUES(2,'product 2',5.5,'test2.png',3,1,1);
CREATE TABLE IF NOT EXISTS "categories" ("categorie_id" integer primary key autoincrement not null, "naam" varchar not null, "pictogram" varchar not null);
INSERT INTO categories VALUES(1,'Food','food-icon');
INSERT INTO categories VALUES(2,'No food','no-food-icon');
CREATE TABLE IF NOT EXISTS "standaard_producten" ("standaard_id" integer primary key autoincrement not null, "naam" varchar not null, "afbeelding" varchar not null, "standaardprijs" float not null, "categorie_id" integer not null, foreign key("categorie_id") references "categories"("categorie_id"));
INSERT INTO standaard_producten VALUES(1,'Koekje','koekje.png',10.5,1);
INSERT INTO standaard_producten VALUES(2,'Snoepje','Snoepje.png',5.0,1);
DELETE FROM sqlite_sequence;
INSERT INTO sqlite_sequence VALUES('migrations',16);
INSERT INTO sqlite_sequence VALUES('categories',2);
INSERT INTO sqlite_sequence VALUES('muntstukken',3);
INSERT INTO sqlite_sequence VALUES('organisaties',3);
INSERT INTO sqlite_sequence VALUES('rollen',3);
INSERT INTO sqlite_sequence VALUES('instellingen',2);
INSERT INTO sqlite_sequence VALUES('verkopen',2);
INSERT INTO sqlite_sequence VALUES('standaard_producten',2);
INSERT INTO sqlite_sequence VALUES('verkooplijnen',2);
INSERT INTO sqlite_sequence VALUES('user_ids',3);
INSERT INTO sqlite_sequence VALUES('wisselgelden',3);
INSERT INTO sqlite_sequence VALUES('producten',2);
INSERT INTO sqlite_sequence VALUES('users',1);
CREATE UNIQUE INDEX "users_email_unique" on "users" ("email");
CREATE INDEX "sessions_user_id_index" on "sessions" ("user_id");
CREATE INDEX "sessions_last_activity_index" on "sessions" ("last_activity");
CREATE INDEX "jobs_queue_index" on "jobs" ("queue");
CREATE UNIQUE INDEX "failed_jobs_uuid_unique" on "failed_jobs" ("uuid");
CREATE INDEX "personal_access_tokens_tokenable_type_tokenable_id_index" on "personal_access_tokens" ("tokenable_type", "tokenable_id");
CREATE UNIQUE INDEX "personal_access_tokens_token_unique" on "personal_access_tokens" ("token");
COMMIT;
