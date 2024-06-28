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
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (idPermiso) REFERENCES Permisos(idPermiso)
);

-- Crear tabla Usuario
CREATE TABLE IF NOT EXISTS Usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    contrasena VARCHAR(255) NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    idRol INT,
    fechaRegistro DATE,
    ultimoAcceso DATE,
    FOREIGN KEY (idRol) REFERENCES Rol(idRol)
);

-- Crear tabla Cliente
CREATE TABLE IF NOT EXISTS Cliente (
    idCliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    telefono VARCHAR(50),
    email VARCHAR(50),
    idUsuario INT,
    fechaRegistro DATE,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario)
);

-- Crear tabla Empleado
CREATE TABLE IF NOT EXISTS Empleado (
    idEmpleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    dni VARCHAR(8),
    telefono VARCHAR(50),
    email VARCHAR(50),
    direccion VARCHAR(100),
    salario DECIMAL(10,2),
    idUsuario INT,
    fechaRegistro DATE,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario)
);

-- Crear tabla TipoDeporte
CREATE TABLE IF NOT EXISTS TipoDeporte (
    idTipoDeporte INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20),
    activo BOOLEAN DEFAULT TRUE,
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
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (idTipoDeporte) REFERENCES TipoDeporte(idTipoDeporte)
);

-- Crear tabla ImplementoDeportivo
CREATE TABLE IF NOT EXISTS ImplementoDeportivo (
    idImplemento INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    descripcion TEXT,
    precioAlquiler DECIMAL(10,2),
    estado VARCHAR(20),
    activo BOOLEAN DEFAULT TRUE,
    fechaRegistro DATE
);

-- Crear tabla EstadoReserva
CREATE TABLE IF NOT EXISTS EstadoReserva (
    idEstado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL,
    descripcion TEXT,
    color VARCHAR(7) NOT NULL DEFAULT '#000000',
    considerar_solapamiento BOOLEAN DEFAULT FALSE
);

-- Crear tabla Reserva
CREATE TABLE IF NOT EXISTS Reserva (
    idReserva INT AUTO_INCREMENT PRIMARY KEY,
    idCampo INT,
    idCliente INT,
    idEmpleado INT,
    detalle TEXT,
    fechaEntrada DATETIME,
    fechaSalida DATETIME,
    duracion INT,
    precioTotal DECIMAL(10,2),
    idEstado INT NOT NULL,
    estado_pago ENUM('pendiente', 'completado', 'parcial') DEFAULT 'pendiente',
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (idCampo) REFERENCES CampoDeportivo(idCampo),
    FOREIGN KEY (idCliente) REFERENCES Cliente(idCliente),
    FOREIGN KEY (idEmpleado) REFERENCES Empleado(idEmpleado),
    FOREIGN KEY (idEstado) REFERENCES EstadoReserva(idEstado)
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
    nombre VARCHAR(20) NOT NULL,
    notas TEXT,
    codigo VARCHAR(10),
    tarifa_adicional DECIMAL(10,2),
    disponible BOOLEAN DEFAULT TRUE,
    url_integracion VARCHAR(255),
    activo BOOLEAN DEFAULT TRUE
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
-- Crear Rol de Administrador, Cliente y Empleado
INSERT INTO Rol (nombre, descripcion) VALUES ('admin', 'Administrador del sistema');
INSERT INTO Rol (nombre, descripcion) VALUES ('cliente', 'Cliente del sistema');
INSERT INTO Rol (nombre, descripcion) VALUES ('empleado', 'Empleado del sistema');

-- Registrar Usuario Administrador
INSERT INTO Usuario (contrasena, activo, idRol, fechaRegistro) 
VALUES ('a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', TRUE, 
    (SELECT idRol FROM Rol WHERE nombre='admin'), CURDATE());  /* PASS 123 */

-- Registrar Empleado Administrador
INSERT INTO Empleado (nombre, apellido, dni, telefono, email, direccion, salario, activo, idUsuario, fechaRegistro) 
VALUES ('NombreAdmin', 'ApellidoAdmin', '12345678', '1234567890', 'admin@example.com', 'DireccionAdmin', 5000.00, TRUE, 1, CURDATE());

-- Insertar Métodos de Pago
INSERT INTO MetodoPago (nombre, notas, codigo, tarifa_adicional, disponible, url_integracion, activo) 
VALUES ('Efectivo', 'Pago en efectivo', 'EFT', 0.00, TRUE, NULL, TRUE);

INSERT INTO MetodoPago (nombre, notas, codigo, tarifa_adicional, disponible, url_integracion, activo) 
VALUES ('Yape', 'Pago a través de Yape', 'YP', 0.00, TRUE, 'https://www.yape.com/api', TRUE);

-- Insertar Tipo de Deporte
INSERT INTO TipoDeporte (nombre, descripcion) VALUES ('Fútbol', 'Deporte de Fútbol');

-- Insertar los Estados Iniciales
INSERT INTO EstadoReserva (nombre, descripcion, considerar_solapamiento, color) VALUES 
('Pendiente', 'Reserva pendiente de confirmación', TRUE, '#87CEFA'),
('Confirmada', 'Reserva confirmada', TRUE, '#1E90FF'),
('En Proceso', 'Reserva en proceso', TRUE, '#32CD32'),
('Completada', 'Reserva completada', FALSE, '#FFD700'),
('Concluida', 'Reserva finalizada', FALSE, '#FFA500'),
('Anulada', 'Reserva cancelada', FALSE, '#FF4500'),
('No Show', 'Cliente no se presentó', FALSE, '#FAF0E6'),
('Reembolsada', 'Reserva reembolsada', FALSE, '#FF7F50');


-- Crear Triggers para Prevenir Eliminación del Empleado Administrador
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
    SET userRoleId = (SELECT idRol FROM Usuario WHERE idUsuario = OLD.idUsuario);

    -- Verificar si el rol del usuario es administrador
    IF userRoleId = adminRoleId THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se puede eliminar al empleado administrador';
    END IF;
END //

DELIMITER ;



