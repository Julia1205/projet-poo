CREATE DATABASE IF NOT EXISTS projetpoo;
USE projetpoo;
CREATE TABLE rank (
    rank_id INT(11) AUTO_INCREMENT NOT NULL,
    rank_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (rank_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE user(
    user_id INT(11) AUTO_INCREMENT NOT NULL,
    user_pseudo VARCHAR(255) NOT NULL,
    user_pwd VARCHAR(255) NOT NULL,
    user_mail VARCHAR(255) NOT NULL,
    user_rank INT(11) NOT NULL,
    user_created_at DATETIME NOT NULL,
    user_updated_at DATETIME NOT NULL,
    PRIMARY KEY (user_id),
    FOREIGN KEY (user_rank)
    REFERENCES rank(rank_id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE glass (
    glass_id INT(11) AUTO_INCREMENT NOT NULL,
    glass_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (glass_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE ingredient (
    ingredient_id INT(11) AUTO_INCREMENT NOT NULL,
    ingredient_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (ingredient_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE cocktail (
    cocktail_id INT(11) AUTO_INCREMENT NOT NULL,
    cocktail_name VARCHAR(255) NOT NULL,
    cocktail_is_alcoholic BOOLEAN NOT NULL,
    cocktail_img VARCHAR(255) NOT NULL,
    cocktail_receipe VARCHAR(255) NOT NULL,
    cocktail_is_archived BOOLEAN NOT NULL,
    cocktail_is_moderated BOOLEAN NOT NULL,
    cocktail_glass_id INT(11) NOT NULL,
    cocktail_created_at DATETIME NOT NULL,
    cocktail_updated_at DATETIME NOT NULL,
    cocktail_id_api INT(11),
    cocktail_user_id INT(11),
    cockail_updated_user_id INT(11),
    FOREIGN KEY (cocktail_glass_id)
    REFERENCES glass(glass_id)
    ON DELETE RESTRICT,
    FOREIGN KEY (cocktail_user_id)
    REFERENCES user(user_id)
    ON DELETE RESTRICT,
    PRIMARY KEY (cocktail_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE cocktail_ingredient (
    cocktail_ingredient_id INT(11) AUTO_INCREMENT NOT NULL,
    cocktail_ingredient_cocktail_id INT(11) NOT NULL,
    cocktail_ingredient_ingredient_id INT(11) NOT NULL,
    cocktail_ingredient_quantity VARCHAR(255) NOT NULL,
    PRIMARY KEY (cocktail_ingredient_id),
    FOREIGN KEY (cocktail_ingredient_cocktail_id)
    REFERENCES cocktail(cocktail_id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
    FOREIGN KEY (cocktail_ingredient_ingredient_id)
    REFERENCES ingredient(ingredient_id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;