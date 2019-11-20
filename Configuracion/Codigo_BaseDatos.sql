DROP TABLE Transacciones;
DROP TABLE TransaccionTarjeta;
DROP TABLE TarjetaCredito;
DROP TABLE CuentaAhorros;
DROP TABLE Credito;
DROP TABLE mensaje;
DROP TABLE Usuario;
DROP TABLE Visitante;


CREATE TABLE Usuario(
    ID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(ID),
    UserName VARCHAR(255) ,
    Password VARCHAR(255),
    type VARCHAR(255),
	CONSTRAINT uc_name unique (UserName)
);

CREATE TABLE Visitante(
	cedula VARCHAR(255),
	PRIMARY KEY (cedula),
	correo varchar(255)
);

CREATE TABLE CuentaAhorros(
    NumCuenta int not null AUTO_INCREMENT,
	PRIMARY KEY (NumCuenta),
	UserID int,
	JaveCoins float default 0,
	cuotaManejo float default 0,
	FOREIGN KEY (UserID) references Usuario (ID)
	ON DELETE CASCADE ON UPDATE CASCADE
);

create table Credito(
	ID int not null AUTO_INCREMENT,
	PRIMARY KEY (ID),
	tasaInteres float DEFAULT 10,
	idUsuario int,
	cedulaVisitante VARCHAR (255),
	cuotaManejo float default 0,
	aprobado BOOLEAN default FALSE,
	FOREIGN KEY (idUsuario) references Usuario (ID)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (cedulaVisitante) references Visitante (cedula)
	ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE TarjetaCredito(
	ID int not null AUTO_INCREMENT,
	PRIMARY KEY (ID),
	idCuenta int,
	cupoMaximo float,
	sobrecupo float,
	cuotaManejo float default 0,
	tasaInteres float default 0,
	aprobada BOOLEAN default FALSE,
	
	FOREIGN KEY (idCuenta) references CuentaAhorros (NumCuenta) ON DELETE CASCADE
);

CREATE TABLE Mensaje(
	mensaje char(255),
	idremitido int,
	idRemitente int,
	FOREIGN KEY (idremitido) references Usuario (ID)
	on delete cascade,
	FOREIGN KEY (idRemitente) references Usuario (ID)
	on delete cascade
);

CREATE TABLE TransaccionTarjeta(
	ID int not null AUTO_INCREMENT,
	PRIMARY KEY (ID),
	TarjetaID INT,
	Cuotas INT,
	Valor FLOAT,
	FechaCompra TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (TarjetaID) REFERENCES TarjetaCredito (ID)
);

CREATE TABLE Transacciones(
	ID int not null AUTO_INCREMENT,
	PRIMARY KEY (ID),
	BancoOrigen varchar(255),
	CuentaOrigen INT,
	CuentaDestino INT,
	Costo float DEFAULT 0,
	ValorTransaccion float DEFAULT 0,
	FechaCompra TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

insert into Usuario(UserName, Password, type) values ('Diego', 'prz/88u.WZ0LU', 'Usuario');
insert into Usuario(UserName, Password, type) values ('Admin', 'prz/88u.WZ0LU', 'Administrador');
