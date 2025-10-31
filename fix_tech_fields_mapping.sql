-- Fix tech_fields table to match ML model expectations
-- The ML model was trained on tech_field_id 1-11
-- Based on the SimplifiedQuestionnaireService career mappings and training data

-- First, clear the existing table
DELETE FROM tech_fields;

-- Insert the correct tech fields with the IDs that match the ML model
INSERT INTO tech_fields (id, name, created_at, updated_at) VALUES
(1, 'Artificial Intelligence', NOW(), NOW()),
(2, 'Cybersecurity', NOW(), NOW()),
(3, 'Data Science & Analytics', NOW(), NOW()),
(4, 'Software Development', NOW(), NOW()),
(5, 'Game Development', NOW(), NOW()),
(6, 'UI/UX Design', NOW(), NOW()),
(7, 'Cloud Computing', NOW(), NOW()),
(8, 'Internet of Things (IoT)', NOW(), NOW()),
(9, 'Blockchain', NOW(), NOW()),
(10, 'Robotics', NOW(), NOW()),
(11, 'Mobile Development', NOW(), NOW());

-- Reset auto-increment to continue from 12
ALTER TABLE tech_fields AUTO_INCREMENT = 12;

-- Verify the mapping
SELECT * FROM tech_fields ORDER BY id;