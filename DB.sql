create table Aprendices(
Doc_usu varchar(15) primary key not null,
Nom_usu varchar(50) not null,
Ape_usu varchar(50) not null,
Ficha int not null,
Cel bigint not null,
Contraseña varchar(80) not null,
Codigo varchar(10) not null,
Fecha_generación timestamp default current_timestamp
);
describe Aprendices;

create table Bicicletas(
Id int auto_increment primary key,
Color_bici varchar(20),
Modelo varchar(50) not null,
Car_bici varchar(100) not null
);
describe Bicicletas;

create table PuestosEstacionamiento (
Id_puesto int primary key not null auto_increment,
Estado enum('Disponible', 'Ocupado') not null default 'Disponible',
Doc_usu varchar(15),
foreign key (Cod_usu) references Aprendices(Codigo)
);

insert into PuestosEstacionamiento (Estado) values
('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'),('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'),('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'),('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'),('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'),('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'),('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'),('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible'), ('Disponible');