CREATE TABLE IF NOT EXISTS `questions` 
(
    `id`                INT AUTO_INCREMENT, 
    `topic`             VARCHAR(100) NOT NULL,
    `difficulty`        VARCHAR(10) NOT NULL,
    `question`          TEXT NOT NULL,
    `constraints`       VARCHAR(200),
    `testcase1`         VARCHAR(200) NOT NULL,
    `output_testcase1`  VARCHAR(200) NOT NULL,
    `testcase2`         VARCHAR(200) NOT NULL,
    `output_testcase2`  VARCHAR(200) NOT NULL,
    `testcase3`         VARCHAR(200),
    `output_testcase3`  VARCHAR(200) ,
    `testcase4`         VARCHAR(200),
    `output_testcase4`  VARCHAR(200) ,
    `testcase5`         VARCHAR(200) ,
    `output_testcase5`  VARCHAR(200) ,
    PRIMARY KEY (`id`)
);

INSERT INTO `create_question` (id, topic, difficulty , question , testcase1 , testcase2) VALUES
(1, "For loop", "Easy", "Write a for loop?", NULL),
(2, "While loop", "Hard","Write a while loop?", Null)