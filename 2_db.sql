--1. You need to run below query using phpMyAdmin.
ALTER TABLE  `Author`
ADD  `username` VARCHAR( 25 ) NOT NULL ,
ADD  `password` VARCHAR( 25 ) NOT NULL ;


--2. Then, You also need to run below query.
-- A- Author's username for login into blog.
-- B- Author's password for login into blog.
-- C- Author's id
-- Tip: If you have several author, you ought to add below query several time.
UPDATE `Sample_blog`.`Author`
SET `username` = 'A', `password` = 'B'
WHERE `Author`.`id` = C;


--3. You need to add 'UNIQUE' for Author's username.
-- It means that username is unique. There are no one else like your name.
ALTER TABLE  `Author`
ADD UNIQUE (`username`);


--4. Finally, execute below query for renaming post.author into post.author_id.
ALTER TABLE  `Post`
CHANGE  `author`  `author_id` INT( 11 ) NOT NULL ;
