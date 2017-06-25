-- table roles
CREATE TABLE IF NOT EXISTS roles(
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,

  PRIMARY KEY (id)
)
ENGINE = InnoDB;

-- table users
CREATE TABLE IF NOT EXISTS users(
  id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role_id INT NOT NULL,

  PRIMARY KEY (id),
  UNIQUE (username),
  FOREIGN KEY (role_id) REFERENCES roles(id)
)
ENGINE = InnoDB;

CREATE TABLE `tb_tasks` (
  `id`            INT           NOT NULL,
  `username`      VARCHAR(50)   NOT NULL,
  `e-mail`        VARCHAR(255)  NOT NULL,
  `description`   VARCHAR(2000) NOT NULL,
  `img`           VARCHAR(50)   NOT NULL,
  `status`        INT           NOT NULL DEFAULT '0'
)
ENGINE = InnoDB;

CREATE VIEW users_view AS
  SELECT users.id, users.username, users.password, roles.name as role
   FROM users, roles
   WHERE users.role_id = roles.id;

-- insert data
INSERT INTO roles (id, name) VALUES (1, 'ROLE_USER');
INSERT INTO roles (id, name) VALUES (2, 'ROLE_ADMIN');

INSERT INTO users (id, username, password, role_id) VALUES (1, 'admin', MD5('123456'), 2);
