CREATE TABLE IF NOT EXISTS `grades` 
(
    `id`                INT AUTO_INCREMENT PRIMARY KEY,
    `question_id`       INT NOT NULL UNIQUE, 
    `question`          TEXT NOT NULL,
    `detail`            TEXT NOT NULL,
    `constraints`        VARCHAR(200),
    `score_constraints`   FLOAT(4),
    `score_name`         FLOAT(4) NOT NULL,
    `score_testcase1`    FLOAT(4) NOT NULL,
    `score_testcase2`    FLOAT(4) NOT NULL,
    `score_testcase3`    FLOAT(4),
    `score_testcase4`    FLOAT(4),
    `score_testcase5`    FLOAT(4),
    `total_score`       INT(4) NOT NULL,
    `comments`           TEXT NOT NULL,
    FOREIGN KEY (`question_id`) REFERENCES questions(id)
);

INSERT INTO `grade` (id,question,recieved_score,total_score,comments) VALUES 
(1, "Write a program in C to display the first 10 natural numbers.", "12","15", "I am happy" ),
(2, "Write a program in C to display n terms of natural number and their sum.", "9","15", "I am happy so much" ),
(3, "Write a program in C to read 10 numbers from keyboard and find their sum and average", "3","15", "I am happy today" );