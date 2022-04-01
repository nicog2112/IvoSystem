create database boutique;
use boutique;

-- 
-- TABLE: AtributosDomicilio 
--

CREATE TABLE AtributosDomicilio(
    id_atributos_domicilio    INT             AUTO_INCREMENT,
    descripcion               VARCHAR(100),
    PRIMARY KEY (id_atributos_domicilio)
)ENGINE=INNODB
;



-- 
-- TABLE: Barrios 
--

CREATE TABLE Barrios(
    id_barrio       INT             AUTO_INCREMENT,
    descripcion     VARCHAR(100),
    id_localidad    INT,
    PRIMARY KEY (id_barrio)
)ENGINE=INNODB
;



-- 
-- TABLE: Categoria 
--

CREATE TABLE Categoria(
    id_categoria    INT          AUTO_INCREMENT,
    nombre          CHAR(100),
    PRIMARY KEY (id_categoria)
)ENGINE=INNODB
;



-- 
-- TABLE: Cliente 
--

CREATE TABLE Cliente(
    id_cliente    INT     AUTO_INCREMENT,
    fecha_alta    DATE,
    id_persona    INT,
    PRIMARY KEY (id_cliente)
)ENGINE=INNODB
;



-- 
-- TABLE: DetalleFacturaImpuestos 
--

CREATE TABLE DetalleFacturaImpuestos(
    id_DetalleFacturaImpuesto    INT            AUTO_INCREMENT,
    valor_porcentaje             FLOAT(8, 0),
    id_factura_detalle           INT,
    id_tipos_impositivos         INT,
    PRIMARY KEY (id_DetalleFacturaImpuesto)
)ENGINE=INNODB
;



-- 
-- TABLE: DetallePedido 
--

CREATE TABLE DetallePedido(
    id_detalle_pedido        INT            AUTO_INCREMENT,
    precio                   FLOAT(8, 0),
    cantidad                 INT,
    id_pedido_cliente        INT,
    id_producto_talle        INT,
    id_producto_promocion    INT,
    PRIMARY KEY (id_detalle_pedido)
)ENGINE=INNODB
;



-- 
-- TABLE: DetallePedidoProveedor 
--

CREATE TABLE DetallePedidoProveedor(
    id_detalle_pedido_proveedor    INT            AUTO_INCREMENT,
    precio                         FLOAT(8, 0),
    cantidad                       INT            NOT NULL,
    id_pedido_proveedor            INT,
    id_producto_talle              INT,
    PRIMARY KEY (id_detalle_pedido_proveedor)
)ENGINE=INNODB
;



-- 
-- TABLE: Devoluciones 
--

CREATE TABLE Devoluciones(
    id_devolucion        INT             AUTO_INCREMENT,
    motivo               VARCHAR(100),
    fecha_hora           TIMESTAMP,
    id_cliente           INT,
    id_producto_talle    INT,
    PRIMARY KEY (id_devolucion)
)ENGINE=INNODB
;



-- 
-- TABLE: Domicilio_Detalle 
--

CREATE TABLE Domicilio_Detalle(
    id_domicilio_detalle      INT             AUTO_INCREMENT,
    valor                     VARCHAR(100),
    id_Domicilios             INT,
    id_atributos_domicilio    INT,
    PRIMARY KEY (id_domicilio_detalle)
)ENGINE=INNODB
;



-- 
-- TABLE: Domicilios 
--

CREATE TABLE Domicilios(
    id_Domicilios    INT    AUTO_INCREMENT,
    id_barrio        INT,
    PRIMARY KEY (id_Domicilios)
)ENGINE=INNODB
;



-- 
-- TABLE: Empleado 
--

CREATE TABLE Empleado(
    id_Empleado      INT         AUTO_INCREMENT,
    numero_legajo    INT,
    fecha_Alta       DATETIME,
    cargo            CHAR(30),
    id_persona       INT,
    PRIMARY KEY (id_Empleado)
)ENGINE=INNODB
;



-- 
-- TABLE: EstadoPedido 
--

CREATE TABLE EstadoPedido(
    id_estado_pedido    INT             AUTO_INCREMENT,
    descripcion         VARCHAR(100),
    PRIMARY KEY (id_estado_pedido)
)ENGINE=INNODB
;



-- 
-- TABLE: Estados_Pagos 
--

CREATE TABLE Estados_Pagos(
    id_estados_pagos    INT             AUTO_INCREMENT,
    descripcion         VARCHAR(100),
    PRIMARY KEY (id_estados_pagos)
)ENGINE=INNODB
;



-- 
-- TABLE: Factura 
--

CREATE TABLE Factura(
    id_factura           INT     AUTO_INCREMENT,
    numeracion           INT,
    FechaEmision         DATE,
    id_estados_pagos     INT,
    id_tipos_facturas    INT,
    PRIMARY KEY (id_factura)
)ENGINE=INNODB
;



-- 
-- TABLE: Facturas_Pagos 
--

CREATE TABLE Facturas_Pagos(
    id_facturas_pagos    INT            AUTO_INCREMENT,
    valor_porcentaje     FLOAT(8, 0),
    fecha_pago           DATETIME,
    id_factura           INT,
    id_tipos_pagos       INT,
    PRIMARY KEY (id_facturas_pagos)
)ENGINE=INNODB
;



-- 
-- TABLE: FacturasDetalles 
--

CREATE TABLE FacturasDetalles(
    id_factura_detalle    INT    AUTO_INCREMENT,
    id_detalle_pedido     INT,
    id_factura            INT,
    PRIMARY KEY (id_factura_detalle)
)ENGINE=INNODB
;



-- 
-- TABLE: Localidades 
--

CREATE TABLE Localidades(
    id_localidad    INT            AUTO_INCREMENT,
    descripcion     VARCHAR(10),
    id_provincia    INT,
    PRIMARY KEY (id_localidad)
)ENGINE=INNODB
;



-- 
-- TABLE: Modulo 
--

CREATE TABLE Modulo(
    id_modulo      INT             AUTO_INCREMENT,
    descripcion    VARCHAR(100),
    PRIMARY KEY (id_modulo)
)ENGINE=INNODB
;



-- 
-- TABLE: Paises 
--

CREATE TABLE Paises(
    id_pais        INT             AUTO_INCREMENT,
    descripcion    VARCHAR(100),
    PRIMARY KEY (id_pais)
)ENGINE=INNODB
;



-- 
-- TABLE: PedidoClente 
--

CREATE TABLE PedidoClente(
    id_pedido_cliente    INT         AUTO_INCREMENT,
    fecha_hora           DATETIME,
    id_cliente           INT,
    id_Empleado          INT,
    id_estado_pedido     INT,
    PRIMARY KEY (id_pedido_cliente)
)ENGINE=INNODB
;



-- 
-- TABLE: PedidoProveedor 
--

CREATE TABLE PedidoProveedor(
    id_pedido_proveedor    INT         AUTO_INCREMENT,
    fecha_hora             DATETIME,
    id_Empleado            INT,
    id_proveedor           INT,
    id_estado_pedido       INT,
    PRIMARY KEY (id_pedido_proveedor)
)ENGINE=INNODB
;



-- 
-- TABLE: Perfil 
--

CREATE TABLE Perfil(
    id_perfil      INT             AUTO_INCREMENT,
    descripcion    VARCHAR(100),
    PRIMARY KEY (id_perfil)
)ENGINE=INNODB
;



-- 
-- TABLE: Perfil_Modulo 
--

CREATE TABLE Perfil_Modulo(
    id_Perfil_Modulo    INT    AUTO_INCREMENT,
    id_perfil           INT,
    id_modulo           INT,
    PRIMARY KEY (id_Perfil_Modulo)
)ENGINE=INNODB
;



-- 
-- TABLE: Persona 
--

CREATE TABLE Persona(
    id_persona             INT            AUTO_INCREMENT,
    nombre                 VARCHAR(50)    NOT NULL,
    apellido               VARCHAR(50)    NOT NULL,
    dni                    INT            NOT NULL,
    fecha_de_nacimiento    DATE,
    nacionalidad           CHAR(30),
    estado                 INT,
    id_sexo                INT,
    PRIMARY KEY (id_persona)
)ENGINE=INNODB
;



-- 
-- TABLE: Persona_Domicilio 
--

CREATE TABLE Persona_Domicilio(
    id_persona_domicilio    INT    AUTO_INCREMENT,
    id_Domicilios           INT,
    id_persona              INT,
    PRIMARY KEY (id_persona_domicilio)
)ENGINE=INNODB
;



-- 
-- TABLE: Persona_TipoContacto 
--

CREATE TABLE Persona_TipoContacto(
    id_persona_tipo_contacto    INT             AUTO_INCREMENT,
    valor                       VARCHAR(100),
    id_persona                  INT,
    id_tipo_contacto            INT,
    PRIMARY KEY (id_persona_tipo_contacto)
)ENGINE=INNODB
;



-- 
-- TABLE: Preventista 
--

CREATE TABLE Preventista(
    id_preventista    INT    AUTO_INCREMENT,
    id_proveedor      INT,
    id_persona        INT,
    PRIMARY KEY (id_preventista)
)ENGINE=INNODB
;



-- 
-- TABLE: Producto 
--

CREATE TABLE Producto(
    id_producto      INT             AUTO_INCREMENT,
    imagen           TEXT,
    nombre           VARCHAR(100),
    marca            VARCHAR(10),
    descripcion      VARCHAR(100),
    precio_compra    FLOAT(8, 0),
    precio_venta     FLOAT(8, 0),
    fecha            TIMESTAMP,
    id_temporada     INT,
    id_categoria     INT,
    PRIMARY KEY (id_producto)
)ENGINE=INNODB
;



-- 
-- TABLE: Producto_Promocion 
--

CREATE TABLE Producto_Promocion(
    id_producto_promocion    INT            AUTO_INCREMENT,
    valor_porcentaje         FLOAT(8, 0),
    id_producto              INT,
    id_promocion             INT,
    PRIMARY KEY (id_producto_promocion)
)ENGINE=INNODB
;



-- 
-- TABLE: ProductoTalle 
--

CREATE TABLE ProductoTalle(
    id_producto_talle      INT    AUTO_INCREMENT,
    cantidad_maxima        INT,
    cantidad_minima        INT,
    cantidad_disponible    INT,
    id_talle               INT,
    id_producto            INT,
    PRIMARY KEY (id_producto_talle)
)ENGINE=INNODB
;



-- 
-- TABLE: Promocion 
--

CREATE TABLE Promocion(
    id_promocion    INT             AUTO_INCREMENT,
    nombre          VARCHAR(100),
    fecha_inicio    DATE,
    fecha_fin       DATE,
    PRIMARY KEY (id_promocion)
)ENGINE=INNODB
;



-- 
-- TABLE: Proveedor 
--

CREATE TABLE Proveedor(
    id_proveedor        INT          AUTO_INCREMENT,
    nombre_proveedor    CHAR(100),
    cuit                INT,
    fecha_alta          DATE,
    PRIMARY KEY (id_proveedor)
)ENGINE=INNODB
;



-- 
-- TABLE: Proveedor_Domicilio 
--

CREATE TABLE Proveedor_Domicilio(
    id_proveedor_domicilio    INT    AUTO_INCREMENT,
    id_Domicilios             INT,
    id_proveedor              INT,
    PRIMARY KEY (id_proveedor_domicilio)
)ENGINE=INNODB
;



-- 
-- TABLE: Proveedor_TipoContacto 
--

CREATE TABLE Proveedor_TipoContacto(
    id_proveedor_tipo_contacto    INT             AUTO_INCREMENT,
    valor                         VARCHAR(100),
    id_proveedor                  INT,
    id_tipo_contacto              INT,
    PRIMARY KEY (id_proveedor_tipo_contacto)
)ENGINE=INNODB
;



-- 
-- TABLE: Provincia 
--

CREATE TABLE Provincia(
    id_provincia    INT             AUTO_INCREMENT,
    descripcion     VARCHAR(100),
    id_pais         INT,
    PRIMARY KEY (id_provincia)
)ENGINE=INNODB
;



-- 
-- TABLE: Sexo 
--

CREATE TABLE Sexo(
    id_sexo        INT         AUTO_INCREMENT,
    descripcion    CHAR(20),
    PRIMARY KEY (id_sexo)
)ENGINE=INNODB
;



-- 
-- TABLE: Talle 
--

CREATE TABLE Talle(
    id_talle       INT             AUTO_INCREMENT,
    descripcion    VARCHAR(100),
    PRIMARY KEY (id_talle)
)ENGINE=INNODB
;



-- 
-- TABLE: Temporada 
--

CREATE TABLE Temporada(
    id_temporada    INT             AUTO_INCREMENT,
    nombre          VARCHAR(100),
    año             DATE,
    PRIMARY KEY (id_temporada)
)ENGINE=INNODB
;



-- 
-- TABLE: Tipo_de_Contacto 
--

CREATE TABLE Tipo_de_Contacto(
    id_tipo_contacto    INT          AUTO_INCREMENT,
    descripcion         CHAR(100),
    PRIMARY KEY (id_tipo_contacto)
)ENGINE=INNODB
;



-- 
-- TABLE: Tipos_Facturas 
--

CREATE TABLE Tipos_Facturas(
    id_tipos_facturas    INT             AUTO_INCREMENT,
    descripcion          VARCHAR(100),
    PRIMARY KEY (id_tipos_facturas)
)ENGINE=INNODB
;



-- 
-- TABLE: Tipos_Impositivos 
--

CREATE TABLE Tipos_Impositivos(
    id_tipos_impositivos    INT             AUTO_INCREMENT,
    descripcion             VARCHAR(100),
    PRIMARY KEY (id_tipos_impositivos)
)ENGINE=INNODB
;



-- 
-- TABLE: Tipos_Pagos 
--

CREATE TABLE Tipos_Pagos(
    id_tipos_pagos    INT             AUTO_INCREMENT,
    descripcion       VARCHAR(100),
    PRIMARY KEY (id_tipos_pagos)
)ENGINE=INNODB
;



-- 
-- TABLE: Usuario 
--

CREATE TABLE Usuario(
    id_usuario    INT             AUTO_INCREMENT,
    username      VARCHAR(100),
    password      VARCHAR(15),
    id_perfil     INT,
    id_persona    INT,
    PRIMARY KEY (id_usuario)
)ENGINE=INNODB
;



-- 
-- TABLE: Barrios 
--

ALTER TABLE Barrios ADD CONSTRAINT RefLocalidades53 
    FOREIGN KEY (id_localidad)
    REFERENCES Localidades(id_localidad)
;


-- 
-- TABLE: Cliente 
--

ALTER TABLE Cliente ADD CONSTRAINT RefPersona9 
    FOREIGN KEY (id_persona)
    REFERENCES Persona(id_persona)
;


-- 
-- TABLE: DetalleFacturaImpuestos 
--

ALTER TABLE DetalleFacturaImpuestos ADD CONSTRAINT RefFacturasDetalles74 
    FOREIGN KEY (id_factura_detalle)
    REFERENCES FacturasDetalles(id_factura_detalle)
;

ALTER TABLE DetalleFacturaImpuestos ADD CONSTRAINT RefTipos_Impositivos75 
    FOREIGN KEY (id_tipos_impositivos)
    REFERENCES Tipos_Impositivos(id_tipos_impositivos)
;


-- 
-- TABLE: DetallePedido 
--

ALTER TABLE DetallePedido ADD CONSTRAINT RefProducto_Promocion87 
    FOREIGN KEY (id_producto_promocion)
    REFERENCES Producto_Promocion(id_producto_promocion)
;

ALTER TABLE DetallePedido ADD CONSTRAINT RefPedidoClente18 
    FOREIGN KEY (id_pedido_cliente)
    REFERENCES PedidoClente(id_pedido_cliente)
;

ALTER TABLE DetallePedido ADD CONSTRAINT RefProductoTalle50 
    FOREIGN KEY (id_producto_talle)
    REFERENCES ProductoTalle(id_producto_talle)
;


-- 
-- TABLE: DetallePedidoProveedor 
--

ALTER TABLE DetallePedidoProveedor ADD CONSTRAINT RefPedidoProveedor11 
    FOREIGN KEY (id_pedido_proveedor)
    REFERENCES PedidoProveedor(id_pedido_proveedor)
;

ALTER TABLE DetallePedidoProveedor ADD CONSTRAINT RefProductoTalle63 
    FOREIGN KEY (id_producto_talle)
    REFERENCES ProductoTalle(id_producto_talle)
;


-- 
-- TABLE: Devoluciones 
--

ALTER TABLE Devoluciones ADD CONSTRAINT RefCliente89 
    FOREIGN KEY (id_cliente)
    REFERENCES Cliente(id_cliente)
;

ALTER TABLE Devoluciones ADD CONSTRAINT RefProductoTalle98 
    FOREIGN KEY (id_producto_talle)
    REFERENCES ProductoTalle(id_producto_talle)
;


-- 
-- TABLE: Domicilio_Detalle 
--

ALTER TABLE Domicilio_Detalle ADD CONSTRAINT RefDomicilios55 
    FOREIGN KEY (id_Domicilios)
    REFERENCES Domicilios(id_Domicilios)
;

ALTER TABLE Domicilio_Detalle ADD CONSTRAINT RefAtributosDomicilio56 
    FOREIGN KEY (id_atributos_domicilio)
    REFERENCES AtributosDomicilio(id_atributos_domicilio)
;


-- 
-- TABLE: Domicilios 
--

ALTER TABLE Domicilios ADD CONSTRAINT RefBarrios54 
    FOREIGN KEY (id_barrio)
    REFERENCES Barrios(id_barrio)
;


-- 
-- TABLE: Empleado 
--

ALTER TABLE Empleado ADD CONSTRAINT RefPersona8 
    FOREIGN KEY (id_persona)
    REFERENCES Persona(id_persona)
;


-- 
-- TABLE: Factura 
--

ALTER TABLE Factura ADD CONSTRAINT RefEstados_Pagos80 
    FOREIGN KEY (id_estados_pagos)
    REFERENCES Estados_Pagos(id_estados_pagos)
;

ALTER TABLE Factura ADD CONSTRAINT RefTipos_Facturas81 
    FOREIGN KEY (id_tipos_facturas)
    REFERENCES Tipos_Facturas(id_tipos_facturas)
;


-- 
-- TABLE: Facturas_Pagos 
--

ALTER TABLE Facturas_Pagos ADD CONSTRAINT RefFactura78 
    FOREIGN KEY (id_factura)
    REFERENCES Factura(id_factura)
;

ALTER TABLE Facturas_Pagos ADD CONSTRAINT RefTipos_Pagos79 
    FOREIGN KEY (id_tipos_pagos)
    REFERENCES Tipos_Pagos(id_tipos_pagos)
;


-- 
-- TABLE: FacturasDetalles 
--

ALTER TABLE FacturasDetalles ADD CONSTRAINT RefDetallePedido73 
    FOREIGN KEY (id_detalle_pedido)
    REFERENCES DetallePedido(id_detalle_pedido)
;

ALTER TABLE FacturasDetalles ADD CONSTRAINT RefFactura76 
    FOREIGN KEY (id_factura)
    REFERENCES Factura(id_factura)
;


-- 
-- TABLE: Localidades 
--

ALTER TABLE Localidades ADD CONSTRAINT RefProvincia52 
    FOREIGN KEY (id_provincia)
    REFERENCES Provincia(id_provincia)
;


-- 
-- TABLE: PedidoClente 
--

ALTER TABLE PedidoClente ADD CONSTRAINT RefCliente19 
    FOREIGN KEY (id_cliente)
    REFERENCES Cliente(id_cliente)
;

ALTER TABLE PedidoClente ADD CONSTRAINT RefEmpleado20 
    FOREIGN KEY (id_Empleado)
    REFERENCES Empleado(id_Empleado)
;

ALTER TABLE PedidoClente ADD CONSTRAINT RefEstadoPedido35 
    FOREIGN KEY (id_estado_pedido)
    REFERENCES EstadoPedido(id_estado_pedido)
;


-- 
-- TABLE: PedidoProveedor 
--

ALTER TABLE PedidoProveedor ADD CONSTRAINT RefEmpleado10 
    FOREIGN KEY (id_Empleado)
    REFERENCES Empleado(id_Empleado)
;

ALTER TABLE PedidoProveedor ADD CONSTRAINT RefProveedor12 
    FOREIGN KEY (id_proveedor)
    REFERENCES Proveedor(id_proveedor)
;

ALTER TABLE PedidoProveedor ADD CONSTRAINT RefEstadoPedido61 
    FOREIGN KEY (id_estado_pedido)
    REFERENCES EstadoPedido(id_estado_pedido)
;


-- 
-- TABLE: Perfil_Modulo 
--

ALTER TABLE Perfil_Modulo ADD CONSTRAINT RefPerfil64 
    FOREIGN KEY (id_perfil)
    REFERENCES Perfil(id_perfil)
;

ALTER TABLE Perfil_Modulo ADD CONSTRAINT RefModulo65 
    FOREIGN KEY (id_modulo)
    REFERENCES Modulo(id_modulo)
;


-- 
-- TABLE: Persona 
--

ALTER TABLE Persona ADD CONSTRAINT RefSexo97 
    FOREIGN KEY (id_sexo)
    REFERENCES Sexo(id_sexo)
;


-- 
-- TABLE: Persona_Domicilio 
--

ALTER TABLE Persona_Domicilio ADD CONSTRAINT RefPersona69 
    FOREIGN KEY (id_persona)
    REFERENCES Persona(id_persona)
;

ALTER TABLE Persona_Domicilio ADD CONSTRAINT RefDomicilios59 
    FOREIGN KEY (id_Domicilios)
    REFERENCES Domicilios(id_Domicilios)
;


-- 
-- TABLE: Persona_TipoContacto 
--

ALTER TABLE Persona_TipoContacto ADD CONSTRAINT RefPersona24 
    FOREIGN KEY (id_persona)
    REFERENCES Persona(id_persona)
;

ALTER TABLE Persona_TipoContacto ADD CONSTRAINT RefTipo_de_Contacto25 
    FOREIGN KEY (id_tipo_contacto)
    REFERENCES Tipo_de_Contacto(id_tipo_contacto)
;


-- 
-- TABLE: Preventista 
--

ALTER TABLE Preventista ADD CONSTRAINT RefProveedor66 
    FOREIGN KEY (id_proveedor)
    REFERENCES Proveedor(id_proveedor)
;

ALTER TABLE Preventista ADD CONSTRAINT RefPersona68 
    FOREIGN KEY (id_persona)
    REFERENCES Persona(id_persona)
;


-- 
-- TABLE: Producto 
--

ALTER TABLE Producto ADD CONSTRAINT RefTemporada71 
    FOREIGN KEY (id_temporada)
    REFERENCES Temporada(id_temporada)
;

ALTER TABLE Producto ADD CONSTRAINT RefCategoria85 
    FOREIGN KEY (id_categoria)
    REFERENCES Categoria(id_categoria)
;


-- 
-- TABLE: Producto_Promocion 
--

ALTER TABLE Producto_Promocion ADD CONSTRAINT RefProducto83 
    FOREIGN KEY (id_producto)
    REFERENCES Producto(id_producto)
;

ALTER TABLE Producto_Promocion ADD CONSTRAINT RefPromocion84 
    FOREIGN KEY (id_promocion)
    REFERENCES Promocion(id_promocion)
;


-- 
-- TABLE: ProductoTalle 
--

ALTER TABLE ProductoTalle ADD CONSTRAINT RefProducto91 
    FOREIGN KEY (id_producto)
    REFERENCES Producto(id_producto)
;

ALTER TABLE ProductoTalle ADD CONSTRAINT RefTalle42 
    FOREIGN KEY (id_talle)
    REFERENCES Talle(id_talle)
;


-- 
-- TABLE: Proveedor_Domicilio 
--

ALTER TABLE Proveedor_Domicilio ADD CONSTRAINT RefProveedor70 
    FOREIGN KEY (id_proveedor)
    REFERENCES Proveedor(id_proveedor)
;

ALTER TABLE Proveedor_Domicilio ADD CONSTRAINT RefDomicilios60 
    FOREIGN KEY (id_Domicilios)
    REFERENCES Domicilios(id_Domicilios)
;


-- 
-- TABLE: Proveedor_TipoContacto 
--

ALTER TABLE Proveedor_TipoContacto ADD CONSTRAINT RefProveedor38 
    FOREIGN KEY (id_proveedor)
    REFERENCES Proveedor(id_proveedor)
;

ALTER TABLE Proveedor_TipoContacto ADD CONSTRAINT RefTipo_de_Contacto40 
    FOREIGN KEY (id_tipo_contacto)
    REFERENCES Tipo_de_Contacto(id_tipo_contacto)
;


-- 
-- TABLE: Provincia 
--

ALTER TABLE Provincia ADD CONSTRAINT RefPaises51 
    FOREIGN KEY (id_pais)
    REFERENCES Paises(id_pais)
;


-- 
-- TABLE: Usuario 
--

ALTER TABLE Usuario ADD CONSTRAINT RefPerfil30 
    FOREIGN KEY (id_perfil)
    REFERENCES Perfil(id_perfil)
;

ALTER TABLE Usuario ADD CONSTRAINT RefPersona96 
    FOREIGN KEY (id_persona)
    REFERENCES Persona(id_persona)
;


-- 
-- TABLE: Barrios 
--

CREATE TABLE Barrios(
    id_barrio       INT             AUTO_INCREMENT,
    descripcion     VARCHAR(100),
    id_localidad    INT,
    PRIMARY KEY (id_barrio)
)ENGINE=INNODB
;



-- 
-- TABLE: Domicilios 
--

CREATE TABLE Domicilios(
    id_Domicilios    INT             AUTO_INCREMENT,
    calle            VARCHAR(30),
    altura           INT,
    manzana          VARCHAR(10),
    numero_casa      INT,
    torre            VARCHAR(10),
    piso             INT,
    observaciones    VARCHAR(250),
    id_barrio        INT,
    PRIMARY KEY (id_Domicilios)
)ENGINE=INNODB
;



-- 
-- TABLE: Localidades 
--

CREATE TABLE Localidades(
    id_localidad    INT            AUTO_INCREMENT,
    descripcion     VARCHAR(10),
    id_provincia    INT,
    PRIMARY KEY (id_localidad)
)ENGINE=INNODB
;



-- 
-- TABLE: Paises 
--

CREATE TABLE Paises(
    id_pais        INT             AUTO_INCREMENT,
    descripcion    VARCHAR(100),
    PRIMARY KEY (id_pais)
)ENGINE=INNODB
;



-- 
-- TABLE: Persona_Domicilio 
--

CREATE TABLE Persona_Domicilio(
    id_persona_domicilio    INT    AUTO_INCREMENT,
    id_Domicilios           INT,
    id_persona              INT,
    PRIMARY KEY (id_persona_domicilio)
)ENGINE=INNODB
;



-- 
-- TABLE: Proveedor_Domicilio 
--

CREATE TABLE Proveedor_Domicilio(
    id_proveedor_domicilio    INT    AUTO_INCREMENT,
    id_Domicilios             INT,
    id_proveedor              INT,
    PRIMARY KEY (id_proveedor_domicilio)
)ENGINE=INNODB
;



-- 
-- TABLE: Provincia 
--

CREATE TABLE Provincia(
    id_provincia    INT             AUTO_INCREMENT,
    descripcion     VARCHAR(100),
    id_pais         INT,
    PRIMARY KEY (id_provincia)
)ENGINE=INNODB
;



-- 
-- TABLE: Barrios 
--

ALTER TABLE Barrios ADD CONSTRAINT RefLocalidades53 
    FOREIGN KEY (id_localidad)
    REFERENCES Localidades(id_localidad)
;


-- 
-- TABLE: Domicilios 
--

ALTER TABLE Domicilios ADD CONSTRAINT RefBarrios54 
    FOREIGN KEY (id_barrio)
    REFERENCES Barrios(id_barrio)
;


-- 
-- TABLE: Localidades 
--

ALTER TABLE Localidades ADD CONSTRAINT RefProvincia52 
    FOREIGN KEY (id_provincia)
    REFERENCES Provincia(id_provincia)
;


-- 
-- TABLE: Persona_Domicilio 
--

ALTER TABLE Persona_Domicilio ADD CONSTRAINT RefDomicilios59 
    FOREIGN KEY (id_Domicilios)
    REFERENCES Domicilios(id_Domicilios)
;

ALTER TABLE Persona_Domicilio ADD CONSTRAINT RefPersona69 
    FOREIGN KEY (id_persona)
    REFERENCES Persona(id_persona)
;


-- 
-- TABLE: Proveedor_Domicilio 
--

ALTER TABLE Proveedor_Domicilio ADD CONSTRAINT RefDomicilios60 
    FOREIGN KEY (id_Domicilios)
    REFERENCES Domicilios(id_Domicilios)
;

ALTER TABLE Proveedor_Domicilio ADD CONSTRAINT RefProveedor70 
    FOREIGN KEY (id_proveedor)
    REFERENCES Proveedor(id_proveedor)
;


-- 
-- TABLE: Provincia 
--

ALTER TABLE Provincia ADD CONSTRAINT RefPaises51 
    FOREIGN KEY (id_pais)
    REFERENCES Paises(id_pais)
;



