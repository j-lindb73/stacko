
DELETE FROM posttypes;
INSERT INTO posttypes (name)
VALUES ('question');
INSERT INTO posttypes (name)
VALUES ('answer');

DELETE FROM users;
INSERT INTO users (email, acronym, password, firstname, lastname)
 VALUES
 ('johan@hasselstigen.se', 'Lefty', '$2y$10$krSTwF.JtDSwx2QLVoXrUeQKTfYwQB2RkHkXDwocersKl3xU6ZwrK', 'Johan', 'Lindberg');


DELETE FROM posts;
INSERT INTO posts (postTypeId, userId, title, text)
   VALUES
   ('1','1','What is the meaning of this site?', 'Can anyone tell me **why** this site exists? ...and if the purpose is legitimate?');

DELETE FROM posttags;
INSERT INTO posttags (post_id, tag_id)
   VALUES
   ('1','1');


DELETE FROM tags;
INSERT INTO tags (tag, count)
  VALUES
  ('First', 1);


