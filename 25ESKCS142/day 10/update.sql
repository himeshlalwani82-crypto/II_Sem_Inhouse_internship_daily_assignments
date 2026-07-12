USE student_management;

-- Add status column if it doesn't already exist
ALTER TABLE students 
ADD COLUMN status VARCHAR(20) DEFAULT 'Active' AFTER photo;