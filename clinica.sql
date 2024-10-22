create database if not exists clinica;

use clinica;

create table if not exists pacientes (
    id int auto_increment primary key,
    nome varchar(255) not null,
    data_nascimento date not null,
    email varchar(255) not null unique,
    telefone varchar(11) not null,
    endereco varchar(255),
    sexo 
);

create table if not exists agendamentos (

    id int auto_increment primary key,
    data_consul date not null,
    hora_consul time not null,
    nome_paciente varchar(255) not null,
    nome_medico varchar(255) not null,
    especialidade  enum('Pediatria', 'Pneumologia', 'Psiquiatria') not null
);