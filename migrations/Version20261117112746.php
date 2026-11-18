<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261117112746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE loan (id INT AUTO_INCREMENT NOT NULL, loan_date DATETIME NOT NULL, return_date_programmed DATE NOT NULL, return_date_real DATE NOT NULL, id_copy_id INT NOT NULL, INDEX IDX_C5D30D0376E88E02 (id_copy_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE work_piece_category (work_piece_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_13CA5FE211BA45F4 (work_piece_id), INDEX IDX_13CA5FE212469DE2 (category_id), PRIMARY KEY (work_piece_id, category_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE work_piece_author (work_piece_id INT NOT NULL, author_id INT NOT NULL, INDEX IDX_65AF817311BA45F4 (work_piece_id), INDEX IDX_65AF8173F675F31B (author_id), PRIMARY KEY (work_piece_id, author_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D0376E88E02 FOREIGN KEY (id_copy_id) REFERENCES copy (id)');
        $this->addSql('ALTER TABLE work_piece_category ADD CONSTRAINT FK_13CA5FE211BA45F4 FOREIGN KEY (work_piece_id) REFERENCES work_piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_piece_category ADD CONSTRAINT FK_13CA5FE212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_piece_author ADD CONSTRAINT FK_65AF817311BA45F4 FOREIGN KEY (work_piece_id) REFERENCES work_piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_piece_author ADD CONSTRAINT FK_65AF8173F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Author_Work_Piece DROP FOREIGN KEY `Author_Work_Piece_ibfk_1`');
        $this->addSql('ALTER TABLE Author_Work_Piece DROP FOREIGN KEY `Author_Work_Piece_ibfk_2`');
        $this->addSql('ALTER TABLE Category_Work_Piece DROP FOREIGN KEY `Category_Work_Piece_ibfk_1`');
        $this->addSql('ALTER TABLE Category_Work_Piece DROP FOREIGN KEY `Category_Work_Piece_ibfk_2`');
        $this->addSql('ALTER TABLE Loans DROP FOREIGN KEY `Loans_ibfk_1`');
        $this->addSql('ALTER TABLE Loans DROP FOREIGN KEY `Loans_ibfk_2`');
        $this->addSql('DROP TABLE Author_Work_Piece');
        $this->addSql('DROP TABLE Category_Work_Piece');
        $this->addSql('DROP TABLE Loans');
        $this->addSql('ALTER TABLE Author MODIFY id_author INT NOT NULL');
        $this->addSql('ALTER TABLE Author CHANGE id_author id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE Category MODIFY id_category INT NOT NULL');
        $this->addSql('ALTER TABLE Category CHANGE id_category id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE Copy DROP FOREIGN KEY `Copy_ibfk_1`');
        $this->addSql('DROP INDEX id_work_piece ON Copy');
        $this->addSql('DROP INDEX inventory_code ON Copy');
        $this->addSql('ALTER TABLE Copy MODIFY id_copy INT NOT NULL');
        $this->addSql('ALTER TABLE Copy ADD id_work_piece_id INT NOT NULL, DROP id_work_piece, CHANGE id_copy id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE Copy ADD CONSTRAINT FK_4DBABB82AF929491 FOREIGN KEY (id_work_piece_id) REFERENCES work_piece (id)');
        $this->addSql('CREATE INDEX IDX_4DBABB82AF929491 ON Copy (id_work_piece_id)');
        $this->addSql('DROP INDEX email ON User');
        $this->addSql('ALTER TABLE User MODIFY id_user INT NOT NULL');
        $this->addSql('ALTER TABLE User CHANGE id_user id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE Work_Piece DROP FOREIGN KEY `Work_Piece_ibfk_1`');
        $this->addSql('DROP INDEX id_work_type ON Work_Piece');
        $this->addSql('ALTER TABLE Work_Piece MODIFY id_work_piece INT NOT NULL');
        $this->addSql('ALTER TABLE Work_Piece CHANGE id_work_piece id INT AUTO_INCREMENT NOT NULL, CHANGE id_work_type work_type_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE Work_Piece ADD CONSTRAINT FK_6C31700C108734B1 FOREIGN KEY (work_type_id) REFERENCES work_type (id)');
        $this->addSql('CREATE INDEX IDX_6C31700C108734B1 ON Work_Piece (work_type_id)');
        $this->addSql('ALTER TABLE Work_Type MODIFY id_work_type INT NOT NULL');
        $this->addSql('ALTER TABLE Work_Type CHANGE libelle libelle VARCHAR(100) NOT NULL, CHANGE id_work_type id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Author_Work_Piece (id_work_piece INT NOT NULL, id_author INT NOT NULL, INDEX id_author (id_author), INDEX IDX_8E071299C9BBF0DB (id_work_piece), PRIMARY KEY (id_work_piece, id_author)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Category_Work_Piece (id_work_piece INT NOT NULL, id_category INT NOT NULL, INDEX id_category (id_category), INDEX IDX_E2377AB2C9BBF0DB (id_work_piece), PRIMARY KEY (id_work_piece, id_category)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Loans (id_loan INT AUTO_INCREMENT NOT NULL, loan_date DATETIME NOT NULL, return_date_programmed DATETIME NOT NULL, return_date_real DATETIME NOT NULL, id_user INT DEFAULT NULL, id_author INT DEFAULT NULL, INDEX id_author (id_author), INDEX id_user (id_user), PRIMARY KEY (id_loan)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE Author_Work_Piece ADD CONSTRAINT `Author_Work_Piece_ibfk_1` FOREIGN KEY (id_work_piece) REFERENCES Work_Piece (id_work_piece) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE Author_Work_Piece ADD CONSTRAINT `Author_Work_Piece_ibfk_2` FOREIGN KEY (id_author) REFERENCES Author (id_author) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE Category_Work_Piece ADD CONSTRAINT `Category_Work_Piece_ibfk_1` FOREIGN KEY (id_work_piece) REFERENCES Work_Piece (id_work_piece) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE Category_Work_Piece ADD CONSTRAINT `Category_Work_Piece_ibfk_2` FOREIGN KEY (id_category) REFERENCES Category (id_category) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE Loans ADD CONSTRAINT `Loans_ibfk_1` FOREIGN KEY (id_user) REFERENCES User (id_user) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE Loans ADD CONSTRAINT `Loans_ibfk_2` FOREIGN KEY (id_author) REFERENCES Author (id_author) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE loan DROP FOREIGN KEY FK_C5D30D0376E88E02');
        $this->addSql('ALTER TABLE work_piece_category DROP FOREIGN KEY FK_13CA5FE211BA45F4');
        $this->addSql('ALTER TABLE work_piece_category DROP FOREIGN KEY FK_13CA5FE212469DE2');
        $this->addSql('ALTER TABLE work_piece_author DROP FOREIGN KEY FK_65AF817311BA45F4');
        $this->addSql('ALTER TABLE work_piece_author DROP FOREIGN KEY FK_65AF8173F675F31B');
        $this->addSql('DROP TABLE loan');
        $this->addSql('DROP TABLE work_piece_category');
        $this->addSql('DROP TABLE work_piece_author');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE author MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE author CHANGE id id_author INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_author)');
        $this->addSql('ALTER TABLE category MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE id id_category INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_category)');
        $this->addSql('ALTER TABLE copy DROP FOREIGN KEY FK_4DBABB82AF929491');
        $this->addSql('DROP INDEX IDX_4DBABB82AF929491 ON copy');
        $this->addSql('ALTER TABLE copy MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE copy ADD id_work_piece INT DEFAULT NULL, DROP id_work_piece_id, CHANGE id id_copy INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_copy)');
        $this->addSql('ALTER TABLE copy ADD CONSTRAINT `Copy_ibfk_1` FOREIGN KEY (id_work_piece) REFERENCES Work_Piece (id_work_piece) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX id_work_piece ON copy (id_work_piece)');
        $this->addSql('CREATE UNIQUE INDEX inventory_code ON copy (inventory_code)');
        $this->addSql('ALTER TABLE user MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE id id_user INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_user)');
        $this->addSql('CREATE UNIQUE INDEX email ON user (email)');
        $this->addSql('ALTER TABLE work_piece DROP FOREIGN KEY FK_6C31700C108734B1');
        $this->addSql('DROP INDEX IDX_6C31700C108734B1 ON work_piece');
        $this->addSql('ALTER TABLE work_piece MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE work_piece CHANGE id id_work_piece INT AUTO_INCREMENT NOT NULL, CHANGE work_type_id id_work_type INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_work_piece)');
        $this->addSql('ALTER TABLE work_piece ADD CONSTRAINT `Work_Piece_ibfk_1` FOREIGN KEY (id_work_type) REFERENCES Work_Type (id_work_type) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX id_work_type ON work_piece (id_work_type)');
        $this->addSql('ALTER TABLE work_type MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE work_type CHANGE libelle libelle VARCHAR(50) NOT NULL, CHANGE id id_work_type INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_work_type)');
    }
}
