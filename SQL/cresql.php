<?php 
    $conn = new mysqli('localhost','root','');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    //Create database
    try{
        $sql = "CREATE DATABASE IF NOT EXISTS Richfield_Chairs";
        $res = $conn->query($sql);
        if ($res) {
            echo('Create database succesfully');
        }else{
            echo('Error create database');
        }
    }catch(Exception $e){
        $e->getMessage();
    }
    $conn->select_db('Richfield_Chairs');
    //Create table user
    try{
        $sql = "CREATE TABLE IF NOT EXISTS USERS(
            USER_ID INT(6) AUTO_INCREMENT PRIMARY KEY,
            USERNAME VARCHAR(40) NOT NULL,
            PASSWORD VARCHAR(40) NOT NULL,
            FULLNAME VARCHAR(40),
            EMAIL VARCHAR(60),
            PHONE VARCHAR(12),
            ADDRESS VARCHAR(60),
            ROLE TINYINT(1)
        )";
        $res = $conn->query($sql);
        if ($res) {
            echo('Create table users succesfully');
        }else{
            echo('Error table users database');
        }
    }catch(Exception $e){
        $e->getMessage();
    }
    //Create table category
    try{
        $sql = "CREATE TABLE IF NOT EXISTS CATEGORY(
            ID_CATEGORY INT(6) AUTO_INCREMENT PRIMARY KEY,
            NAME_CATEGORY VARCHAR(40)
        )";
        $res = $conn->query($sql);
        if ($res) {
            echo('Create table category succesfully');
        }else{
            echo('Error table category database');
        }
    }catch(Exception $e){
        $e->getMessage();
    }
    //Create table brand
    try{
        $sql = "CREATE TABLE IF NOT EXISTS BRAND(
            ID_BRAND int(6) AUTO_INCREMENT PRIMARY KEY,
            NAME_BRAND varchar(40),
            EMAIL VARCHAR(60),
            PHONE VARCHAR(12),
            ADDRESS VARCHAR(60)
        )";
        $res = $conn->query($sql);
        if ($res) {
            echo('Create table brand succesfully');
        }else{
            echo('Error table brand database');
        }
    }catch(Exception $e){
        $e->getMessage();
    }
    //Create table product
    try{
        $sql = "CREATE TABLE IF NOT EXISTS PRODUCT(
            ID_PRODUCT INT(6) AUTO_INCREMENT PRIMARY KEY,
            ID_BRAND INT(6) NOT NULL,
            FOREIGN KEY(ID_BRAND) REFERENCES BRAND(ID_BRAND),
            ID_CATEGORY INT(6) NOT NULL,
            FOREIGN KEY(ID_CATEGORY) REFERENCES CATEGORY(ID_CATEGORY),
            PRODUCT_NAME VARCHAR(40),
            PRICE FLOAT,
            DESCRIPTION TEXT,
            IMG_PRODUCT VARCHAR(255),
            DESCRIPTION_LINK VARCHAR(255)
        )";
        $res = $conn->query($sql);
        if ($res) {
            echo('Create table product succesfully');
        }else{
            echo('Error table product database');
        }
    }catch(Exception $e){
        $e->getMessage();
    }
    //Create table order
    try{
        $sql = "CREATE TABLE IF NOT EXISTS `ORDER`(
            ORDER_ID INT(6) AUTO_INCREMENT PRIMARY KEY,
            USER_ID INT(6) NOT NULL,
            FOREIGN KEY(USER_ID) REFERENCES USERS(USER_ID),
            ID_PRODUCT INT(6) NOT NULL,
            FOREIGN KEY(ID_PRODUCT) REFERENCES PRODUCT(ID_PRODUCT),
            CREATE_AT DATETIME
        )";
        $res = $conn->query($sql);
        if ($res) {
            echo('Create table order succesfully');
        }else{
            echo('Error table order database');
        }
    }catch(Exception $e){
        $e->getMessage();
    }
    //Create table order detail
    try{
        $sql = "CREATE TABLE IF NOT EXISTS ORDER_DETAIL(
            ORDER_DETAIL_ID INT(6) AUTO_INCREMENT PRIMARY KEY,
            ORDER_ID INT(6) NOT NULL,
            FOREIGN KEY(ORDER_ID) REFERENCES   `ORDER`(ORDER_ID),
            ID_PRODUCT INT(6) NOT NULL,
            FOREIGN KEY(ID_PRODUCT) REFERENCES PRODUCT(ID_PRODUCT),
            QUANTITY INT,
            PRICE FLOAT
        )";
        $res = $conn->query($sql);
        if ($res) {
            echo('Create table order_detail succesfully');
        }else{
            echo('Error table order_detail database');
        }
    }catch(Exception $e){
        $e->getMessage();
    }
?>