CREATE TABLE IF NOT EXISTS `exam` 
(
    `id`                INT AUTO_INCREMENT PRIMARY KEY, 
    `question_id`       INT NOT NULL UNIQUE, 
    `question`          TEXT NOT NULL,
    `score`             INT(4) NOT NULL,
    `answer`            TEXT,
    FOREIGN KEY (`question_id`) REFERENCES questions(id)

);
INSERT INTO `Exam` (question,score) VALUES (5) ;

INSERT INTO Exam (question,score) SELECT question,'5' FROM questions WHERE id ='6';

INSERT INTO Exam (question,score) SELECT question,'2' FROM questions WHERE id ='6' ON DUPLICATE KEY UPDATE score ='7';

INSERT INTO Exam (question,score) SELECT question,'2' FROM questions WHERE id ='6' ;