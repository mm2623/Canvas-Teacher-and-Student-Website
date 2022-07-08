CREATE TABLE IF NOT EXISTS `Users` 
(
    `id`                int AUTO_INCREMENT, 
    `email`             VARCHAR(100) NOT NULL,
    `password`          VARCHAR(256) NOT NULL,
    `status`            TEXT
    ,PRIMARY KEY (`id`)
    ,UNIQUE (`email`)
);

INSERT INTO `Users` (id, email, password , status) VALUES
(1, "teacher@njit.edu", "$2y$10$jt0WbBTeylyVDUpQ7XceV.65xeGtCz9eKe2K/I/B.I9aFatytXRLa", "TEACHER"),
(2, "student@njit.edu", "$2y$10$AOsrSeH2lwP.fBOlxrZwBesJI3shS4cIF4nrA2illhR9KXYmOa9AW","STUDENT")