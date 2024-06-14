
-- Crear tabla Permisos
CREATE TABLE IF NOT EXISTS Permisos (
    idPermiso INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL,
    c VARCHAR(20),
    r VARCHAR(20),
    u VARCHAR(20),
    d VARCHAR(20) 
);

-- Crear tabla Rol
CREATE TABLE IF NOT EXISTS Rol (
    idRol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL,
    descripcion TEXT,
    idPermiso INT,
    FOREIGN KEY (idPermiso) REFERENCES Permisos(idPermiso)
);

-- Crear tabla Usuario
CREATE TABLE IF NOT EXISTS Usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(20) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    estado BOOLEAN,
    idRol INT,
    fechaRegistro DATE,
    FOREIGN KEY (idRol) REFERENCES Rol(idRol)
);

-- Crear tabla Persona
CREATE TABLE IF NOT EXISTS Persona (
    idPersona INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    telefono VARCHAR(50),
    email VARCHAR(50),
    tipo ENUM('cliente', 'empleado') NOT NULL,
    idUsuario INT,
    fechaRegistro DATE,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario)
);

-- Crear tabla Cliente
CREATE TABLE IF NOT EXISTS Cliente (
    idCliente INT PRIMARY KEY,
    FOREIGN KEY (idCliente) REFERENCES Persona(idPersona)
);

-- Crear tabla Empleado
CREATE TABLE IF NOT EXISTS Empleado (
    idEmpleado INT PRIMARY KEY,
    FOREIGN KEY (idEmpleado) REFERENCES Persona(idPersona)
);

-- Crear tabla TipoDeporte
CREATE TABLE IF NOT EXISTS TipoDeporte (
    idTipoDeporte INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20),
    descripcion TEXT
);

-- Crear tabla CampoDeportivo
CREATE TABLE IF NOT EXISTS CampoDeportivo (
    idCampo INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20) NOT NULL,
    alquilerHora DECIMAL(10,2) NOT NULL,
    idTipoDeporte INT,
    estado VARCHAR(20),
    disponible BOOLEAN,
    FOREIGN KEY (idTipoDeporte) REFERENCES TipoDeporte(idTipoDeporte)
);

-- Crear tabla ImplementoDeportivo
CREATE TABLE IF NOT EXISTS ImplementoDeportivo (
    idImplemento INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    descripcion TEXT,
    precioAlquiler DECIMAL(10,2),
    estado VARCHAR(20),
    fechaRegistro DATE
);

-- Crear tabla Reserva
CREATE TABLE IF NOT EXISTS Reserva (
    idReserva INT AUTO_INCREMENT PRIMARY KEY,
    idCampo INT,
    idPersonaCliente INT,
    idPersonaEmpleado INT,
    detalle TEXT,
    fechaEntrada DATETIME,
    fechaSalida DATETIME,
    duracion INT,
    precioTotal DECIMAL(10,2),
    estado VARCHAR(20),
    FOREIGN KEY (idCampo) REFERENCES CampoDeportivo(idCampo),
    FOREIGN KEY (idPersonaCliente) REFERENCES Cliente(idCliente),
    FOREIGN KEY (idPersonaEmpleado) REFERENCES Empleado(idEmpleado)
);

-- Crear tabla ImplementoDeportivo_Reserva
CREATE TABLE IF NOT EXISTS ImplementoDeportivo_Reserva (
    idImplemento INT,
    idReserva INT,
    Cantidad INT,
    PrecioTotal DECIMAL(10,2),
    PRIMARY KEY (idImplemento, idReserva),
    FOREIGN KEY (idImplemento) REFERENCES ImplementoDeportivo(idImplemento),
    FOREIGN KEY (idReserva) REFERENCES Reserva(idReserva)
);

-- Crear tabla MetodoPago
CREATE TABLE IF NOT EXISTS MetodoPago (
    idMetodoPago INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20),
    descripcion TEXT
);

-- Crear tabla Pagos
CREATE TABLE IF NOT EXISTS Pagos (
    idPago INT AUTO_INCREMENT PRIMARY KEY,
    monto DECIMAL(10,2),
    fechaPago DATETIME,
    observacion VARCHAR(255),
    idReserva INT,
    idMetodoPago INT,
    FOREIGN KEY (idReserva) REFERENCES Reserva(idReserva),
    FOREIGN KEY (idMetodoPago) REFERENCES MetodoPago(idMetodoPago)
);

-- Insertar datos iniciales
-- Crear Rol de Administrador
INSERT INTO Rol (nombre, descripcion) VALUES ('admin', 'Administrador del sistema');

-- Registrar Usuario Administrador
INSERT INTO Usuario (usuario, contrasena, estado, idRol, fechaRegistro) 
VALUES ('admin_user', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, 
    (SELECT idRol FROM Rol WHERE nombre='admin'), CURDATE());  /* PASS 123 */

-- Registrar Persona Administrador
INSERT INTO Persona (nombre, apellido, telefono, email, tipo, idUsuario, fechaRegistro) 
VALUES ('NombreAdmin', 'ApellidoAdmin', '1234567890', 'admin@example.com', 'empleado', 
    (SELECT idUsuario FROM Usuario WHERE usuario='admin_user'), CURDATE());

-- Registrar Empleado Administrador
INSERT INTO Empleado (idEmpleado) 
VALUES ((SELECT idPersona FROM Persona WHERE email='admin@example.com'));

-- Crear Trigger para Prevenir Eliminación del Empleado Administrador
DELIMITER //

CREATE TRIGGER prevent_admin_employee_deletion
BEFORE DELETE ON Empleado
FOR EACH ROW
BEGIN
    DECLARE adminRoleId INT;
    DECLARE userRoleId INT;

    -- Obtener el id del rol de administrador
    SET adminRoleId = (SELECT idRol FROM Rol WHERE nombre = 'admin');

    -- Obtener el id del rol del usuario asociado al empleado
    SET userRoleId = (SELECT idRol FROM Usuario WHERE idUsuario = (SELECT idUsuario FROM Persona WHERE idPersona = OLD.idEmpleado));

    -- Verificar si el rol del usuario es administrador
    IF userRoleId = adminRoleId THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se puede eliminar al empleado administrador';
    END IF;
END //

DELIMITER ;
