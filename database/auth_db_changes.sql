-- ======================================================
-- Enrollzy Frontend - Authentication Database Changes SQL
-- Date: 2026-07-30
-- Description: Adds mobile number, role, admin status, and image columns
--              to users table, and makes name, email, password nullable for OTP login.
-- ======================================================

-- 1. Add new columns to `users` table
ALTER TABLE `users` 
  ADD COLUMN `mobile` VARCHAR(255) NULL UNIQUE AFTER `email`,
  ADD COLUMN `is_admin` TINYINT(1) NOT NULL DEFAULT 0 AFTER `mobile`,
  ADD COLUMN `role` VARCHAR(255) NULL AFTER `is_admin`,
  ADD COLUMN `image` VARCHAR(255) NULL AFTER `role`;

-- 2. Modify existing columns to be nullable for OTP Auto-Registration
ALTER TABLE `users` 
  MODIFY COLUMN `name` VARCHAR(255) NULL,
  MODIFY COLUMN `email` VARCHAR(255) NULL,
  MODIFY COLUMN `password` VARCHAR(255) NULL;
