# Esquema de Base de Datos — HerzTrace

> Referencia generada del backup `mysql_backup_2026_05_01_00_00_01.sql`.  
> Usar como documento base para ampliar o eliminar campos según los requerimientos de la app.

---

## Índice de Tablas

### Módulo Core / Catálogos
- [areas](#areas)
- [categories](#categories)
- [institutes](#institutes)
- [machines](#machines)
- [procesos](#procesos)
- [products](#products)
- [units](#units)
- [settings](#settings)

### Módulo Trazabilidad (flujo principal)
- [receptions](#receptions) → [preparations](#preparations) → [labelqrs](#labelqrs) → [discharges](#discharges) → [stocks](#stocks) → [expeditions](#expeditions)

### Tablas de Detalle
- [reception_details](#reception_details)
- [preparation_details](#preparation_details)
- [preparation_quantity_resets](#preparation_quantity_resets)
- [labelqr_details](#labelqr_details)
- [discharge_details](#discharge_details)
- [stock_details](#stock_details)
- [expedition_details](#expedition_details)

### Módulo Auxiliar / Pruebas
- [informats](#informats)
- [instrumentals](#instrumentals)
- [lotes](#lotes)
- [testbds](#testbds)
- [testvacuums](#testvacuums)

### Módulo Sistema / Auth
- [users](#users)
- [roles](#roles)
- [permissions](#permissions)
- [model_has_roles](#model_has_roles)
- [model_has_permissions](#model_has_permissions)
- [role_has_permissions](#role_has_permissions)
- [licence_expirations](#licence_expirations)
- [media](#media)
- [uploads](#uploads)

### Laravel Interno
- [failed_jobs](#failed_jobs)
- [migrations](#migrations)
- [password_resets](#password_resets)

---

## Módulo Core / Catálogos

### `areas`
Zonas o servicios del hospital donde se envían materiales.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `area_code` | varchar(255) | NO | Código único del área (ej. `Area_01`) |
| `area_name` | varchar(255) | NO | Nombre del área (ej. `QUIROFANO`) |
| `area_responsable` | varchar(255) | SÍ | Nombre del responsable |
| `area_piso` | varchar(255) | SÍ | Piso/ubicación física |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `categories`
Categorías de clasificación de productos.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `category_code` | varchar(255) | NO | Código único (ej. `CA_01`) — UNIQUE |
| `category_name` | varchar(255) | NO | Nombre de la categoría |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `institutes`
Datos del hospital o institución que usa el sistema.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `institute_code` | varchar(255) | NO | Código único — UNIQUE |
| `institute_name` | varchar(255) | NO | Nombre de la institución |
| `institute_address` | varchar(255) | NO | Dirección |
| `institute_area` | varchar(255) | NO | Área o departamento |
| `institute_city` | varchar(255) | NO | Ciudad |
| `institute_country` | varchar(255) | NO | País |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `machines`
Equipos de esterilización registrados.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `machine_code` | varchar(255) | NO | Código único — UNIQUE |
| `machine_name` | varchar(255) | NO | Nombre del equipo |
| `machine_model` | varchar(255) | NO | Modelo |
| `machine_type` | varchar(255) | NO | Tipo (autoclave, plasma, etc.) |
| `machine_serial` | varchar(255) | NO | Número de serie |
| `machine_factory` | varchar(255) | NO | Fabricante |
| `machine_country` | varchar(255) | NO | País de fabricación |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `procesos`
Tipos de procesos de esterilización disponibles.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `proceso_code` | varchar(255) | NO | Código del proceso |
| `proceso_name` | varchar(255) | NO | Nombre del proceso |
| `proceso_type` | varchar(255) | NO | Tipo (ej. vapor, plasma) |
| `proceso_temp` | varchar(255) | NO | Temperatura del proceso |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `products`
Catálogo de productos/instrumentos gestionados.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `category_id` | bigint unsigned | NO | FK → `categories.id` |
| `product_name` | varchar(255) | NO | Nombre del producto |
| `product_code` | varchar(255) | SÍ | Código único — UNIQUE |
| `product_barcode_symbology` | varchar(255) | SÍ | Simbología de código de barras |
| `product_type_process` | varchar(255) | SÍ | Tipo de proceso requerido |
| `product_quantity` | int | SÍ | Cantidad por defecto |
| `product_patient` | varchar(255) | SÍ | Paciente asociado (si aplica) |
| `product_info` | varchar(255) | SÍ | Información adicional |
| `area` | varchar(255) | SÍ | Área destino por defecto |
| `product_price` | int | NO | Precio |
| `product_unit` | varchar(255) | SÍ | Unidad de medida |
| `product_note` | text | SÍ | Notas adicionales |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `units`
Unidades de medida disponibles.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `name` | varchar(255) | SÍ | Nombre completo (ej. `Unidad`) |
| `short_name` | varchar(255) | SÍ | Abreviatura (ej. `ud`) |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `settings`
Configuración general de la aplicación.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `company_name` | varchar(255) | NO | Nombre de la empresa/hospital |
| `company_email` | varchar(255) | NO | Email institucional |
| `company_phone` | varchar(255) | NO | Teléfono |
| `site_logo` | varchar(255) | SÍ | Ruta del logo |
| `notification_email` | varchar(255) | NO | Email para notificaciones |
| `footer_text` | text | NO | Texto del pie de página |
| `company_address` | text | NO | Dirección completa |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

## Módulo Trazabilidad

### `receptions`
Recepción de material sucio proveniente de las áreas.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `reference` | varchar(255) | NO | Número de referencia |
| `area_id` | bigint unsigned | SÍ | FK → `areas.id` |
| `operator` | varchar(255) | NO | Operador que recibió |
| `delivery_staff` | varchar(255) | SÍ | Personal que entregó |
| `area` | varchar(255) | NO | Nombre del área (texto) |
| `total_amount` | int | NO | Total de ítems recibidos |
| `status` | varchar(255) | NO | Estado de la recepción |
| `note` | text | SÍ | Observaciones |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `reception_details`
Ítems individuales de cada recepción.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `product_id` | bigint unsigned | SÍ | FK → `products.id` |
| `reception_id` | bigint unsigned | NO | FK → `receptions.id` (CASCADE) |
| `product_name` | varchar(255) | NO | Nombre del producto |
| `product_code` | varchar(255) | NO | Código del producto |
| `product_quantity` | int | NO | Cantidad recibida |
| `price` | int | NO | Precio total |
| `unit_price` | int | NO | Precio unitario |
| `sub_total` | int | NO | Subtotal |
| `product_patient` | varchar(255) | SÍ | Paciente |
| `product_info` | varchar(255) | SÍ | Info adicional |
| `product_outside_company` | varchar(255) | SÍ | Empresa externa |
| `product_area` | varchar(255) | SÍ | Área de origen |
| `product_type_dirt` | varchar(255) | NO | Tipo de suciedad |
| `product_state_rumed` | varchar(255) | SÍ | Estado (remojado, etc.) |
| `product_type_process` | varchar(255) | SÍ | Tipo de proceso requerido |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `preparations`
Preparación/empaque del material limpio previo a esterilización.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `reception_id` | bigint unsigned | NO | FK → `receptions.id` (CASCADE) |
| `reference` | varchar(255) | NO | Número de referencia |
| `operator` | varchar(255) | NO | Operador |
| `note` | text | SÍ | Observaciones |
| `total_amount` | int | NO | Total de ítems preparados |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `preparation_details`
Ítems individuales de cada preparación.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `product_id` | bigint unsigned | SÍ | FK → `products.id` |
| `preparation_id` | bigint unsigned | NO | FK → `preparations.id` (CASCADE) |
| `product_name` | varchar(255) | NO | Nombre del producto |
| `product_code` | varchar(255) | NO | Código del producto |
| `product_quantity` | int | NO | Cantidad |
| `price` | int | NO | Precio total |
| `unit_price` | int | NO | Precio unitario |
| `unit` | varchar(255) | SÍ | Unidad |
| `product_patient` | varchar(255) | SÍ | Paciente |
| `product_info` | varchar(255) | SÍ | Info adicional |
| `product_outside_company` | varchar(255) | SÍ | Empresa externa |
| `product_area` | varchar(255) | SÍ | Área destino |
| `product_state_preparation` | varchar(255) | SÍ | Estado de preparación |
| `product_coming_zone` | varchar(255) | SÍ | Zona de procedencia |
| `product_type_process` | varchar(255) | SÍ | Tipo de proceso |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `preparation_quantity_resets`
Auditoría de reseteos de cantidad en preparación.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `preparation_detail_id` | bigint unsigned | NO | FK → `preparation_details.id` (CASCADE) |
| `user_id` | bigint unsigned | NO | FK → `users.id` (CASCADE) |
| `previous_quantity` | int | NO | Cantidad anterior |
| `new_quantity` | int | NO | Nueva cantidad (default 0) |
| `product_name` | varchar(255) | NO | Nombre del producto |
| `product_code` | varchar(255) | NO | Código del producto |
| `product_area` | varchar(255) | SÍ | Área |
| `product_type_process` | varchar(255) | SÍ | Tipo de proceso |
| `reset_at` | timestamp | NO | Fecha/hora del reseteo |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `labelqrs`
Registro del ciclo de esterilización con etiqueta QR.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `reference` | varchar(255) | NO | Número de referencia |
| `machine_name` | varchar(255) | NO | Nombre del equipo |
| `machine_type` | varchar(255) | NO | Tipo de equipo |
| `lote_machine` | varchar(255) | NO | Lote del equipo |
| `temp_machine` | varchar(255) | NO | Temperatura del equipo |
| `type_program` | varchar(255) | NO | Tipo de programa |
| `lote_biologic` | varchar(255) | NO | Lote biológico |
| `total_amount` | int | NO | Total de ítems |
| `lote_agente` | text | SÍ | Lote agente esterilizante |
| `validation_biologic` | varchar(255) | SÍ | Validación biológica |
| `temp_ambiente` | varchar(255) | NO | Temperatura ambiente |
| `status_cycle` | varchar(255) | SÍ | Estado del ciclo |
| `note_labelqr` | text | SÍ | Notas |
| `operator` | varchar(255) | NO | Operador |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `labelqr_details`
Ítems individuales de cada ciclo de esterilización.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `labelqr_id` | bigint unsigned | NO | FK → `labelqrs.id` (CASCADE) |
| `preparation_detail_id` | bigint unsigned | NO | FK → `preparation_details.id` (CASCADE) |
| `product_id` | bigint unsigned | SÍ | FK → `products.id` |
| `product_name` | varchar(255) | NO | Nombre del producto |
| `product_code` | varchar(255) | NO | Código del producto |
| `product_quantity` | int | NO | Cantidad esterilizada |
| `product_quantity_fail` | int | SÍ | Cantidad fallida |
| `product_operator_package` | varchar(255) | SÍ | Operador empaque |
| `price` | int | NO | Precio total |
| `unit_price` | int | NO | Precio unitario |
| `sub_total` | int | NO | Subtotal |
| `product_package_wrap` | varchar(255) | NO | Tipo de empaque |
| `product_patient` | varchar(255) | SÍ | Paciente |
| `product_info` | varchar(255) | SÍ | Info adicional |
| `product_outside_company` | varchar(255) | SÍ | Empresa externa |
| `product_area` | varchar(255) | SÍ | Área destino |
| `product_ref_qr` | varchar(255) | SÍ | Referencia QR |
| `product_eval_package` | varchar(255) | SÍ | Evaluación empaque |
| `product_eval_indicator` | varchar(255) | SÍ | Evaluación indicador |
| `product_expiration` | varchar(255) | SÍ | Fecha vencimiento |
| `product_type_process` | varchar(255) | SÍ | Tipo de proceso |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `discharges`
Descarga/retiro del material esterilizado.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `labelqr_id` | bigint unsigned | NO | FK → `labelqrs.id` (CASCADE) |
| `reference` | varchar(255) | NO | Número de referencia |
| `machine_name` | varchar(255) | NO | Nombre del equipo |
| `machine_type` | varchar(255) | NO | Tipo del equipo |
| `lote_machine` | varchar(255) | NO | Lote del equipo |
| `lote_agente` | varchar(255) | SÍ | Lote agente esterilizante |
| `temp_machine` | varchar(255) | NO | Temperatura del equipo |
| `type_program` | varchar(255) | NO | Tipo de programa |
| `lote_biologic` | varchar(255) | NO | Lote biológico |
| `total_amount` | int | NO | Total de ítems |
| `validation_biologic` | varchar(255) | SÍ | Validación biológica |
| `temp_ambiente` | varchar(255) | NO | Temperatura ambiente |
| `status_cycle` | varchar(255) | SÍ | Estado del ciclo |
| `ruta_process` | varchar(255) | SÍ | Ruta del proceso |
| `note` | text | SÍ | Observaciones |
| `operator` | varchar(255) | NO | Operador que cargó |
| `operator_discharge` | varchar(255) | SÍ | Operador que descargó |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `discharge_details`
Ítems individuales de cada descarga.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `discharge_id` | bigint unsigned | NO | FK → `discharges.id` (CASCADE) |
| `product_id` | bigint unsigned | SÍ | FK → `products.id` |
| `labelqr_detail_id` | bigint unsigned | NO | FK → `labelqr_details.id` (CASCADE) |
| `product_name` | varchar(255) | NO | Nombre del producto |
| `product_code` | varchar(255) | NO | Código del producto |
| `product_quantity` | int | NO | Cantidad |
| `price` | int | NO | Precio total |
| `unit_price` | int | NO | Precio unitario |
| `sub_total` | int | NO | Subtotal |
| `product_package_wrap` | varchar(255) | NO | Tipo de empaque |
| `product_outside_company` | varchar(255) | SÍ | Empresa externa |
| `product_area` | varchar(255) | SÍ | Área destino |
| `product_patient` | varchar(255) | SÍ | Paciente |
| `product_info` | varchar(255) | SÍ | Info adicional |
| `product_ref_qr` | varchar(255) | SÍ | Referencia QR |
| `product_eval_package` | varchar(255) | SÍ | Evaluación empaque |
| `product_eval_indicator` | varchar(255) | SÍ | Evaluación indicador |
| `product_expiration` | varchar(255) | SÍ | Fecha vencimiento |
| `product_type_process` | varchar(255) | SÍ | Tipo de proceso |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `stocks`
Stock de material esterilizado disponible para despacho.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `discharge_id` | bigint unsigned | NO | FK → `discharges.id` (CASCADE) |
| `reference` | varchar(255) | NO | Número de referencia |
| `lote_machine` | varchar(255) | NO | Lote del equipo |
| `machine_name` | varchar(255) | NO | Nombre del equipo |
| `lote_biologic` | varchar(255) | NO | Lote biológico |
| `temp_ambiente` | varchar(255) | SÍ | Temperatura ambiente |
| `note` | text | SÍ | Observaciones |
| `operator` | varchar(255) | NO | Operador |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `stock_details`
Ítems individuales de stock disponible.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `stock_id` | bigint unsigned | NO | FK → `stocks.id` (CASCADE) |
| `product_id` | bigint unsigned | SÍ | FK → `products.id` |
| `product_name` | varchar(255) | NO | Nombre del producto |
| `product_code` | varchar(255) | NO | Código del producto |
| `product_quantity` | int | NO | Cantidad en stock |
| `product_quantity_expedition` | int | SÍ | Cantidad despachada |
| `price` | int | NO | Precio total |
| `unit_price` | int | NO | Precio unitario |
| `sub_total` | int | NO | Subtotal |
| `product_area` | varchar(255) | SÍ | Área destino |
| `product_patient` | varchar(255) | SÍ | Paciente |
| `product_info` | varchar(255) | SÍ | Info adicional |
| `product_outside_company` | varchar(255) | SÍ | Empresa externa |
| `product_package_wrap` | varchar(255) | NO | Tipo de empaque |
| `product_ref_qr` | varchar(255) | SÍ | Referencia QR |
| `product_status_stock` | varchar(255) | SÍ | Estado en stock |
| `product_date_sterilized` | timestamp | NO | Fecha de esterilización |
| `product_expiration` | timestamp | SÍ | Fecha de vencimiento |
| `product_type_process` | varchar(255) | SÍ | Tipo de proceso |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `expeditions`
Despacho de material esterilizado a las áreas.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `reference` | varchar(255) | NO | Número de referencia |
| `area_expedition` | varchar(255) | NO | Área de destino |
| `staff_expedition` | varchar(255) | NO | Personal que recibe |
| `temp_ambiente` | varchar(255) | NO | Temperatura ambiente |
| `status_expedition` | varchar(255) | NO | Estado de la expedición |
| `total_amount` | int | NO | Total de ítems |
| `note` | text | SÍ | Observaciones |
| `operator` | varchar(255) | NO | Operador |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `expedition_details`
Ítems individuales de cada despacho.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `product_id` | bigint unsigned | SÍ | FK → `products.id` |
| `expedition_id` | bigint unsigned | NO | FK → `expeditions.id` (CASCADE) |
| `stock_detail_id` | bigint unsigned | NO | FK → `stock_details.id` (CASCADE) |
| `product_name` | varchar(255) | NO | Nombre del producto |
| `product_code` | varchar(255) | NO | Código del producto |
| `product_quantity` | int | NO | Cantidad |
| `price` | int | NO | Precio total |
| `unit_price` | int | NO | Precio unitario |
| `sub_total` | int | NO | Subtotal |
| `product_patient` | varchar(255) | SÍ | Paciente |
| `product_info` | varchar(255) | SÍ | Info adicional |
| `product_outside_company` | varchar(255) | SÍ | Empresa externa |
| `product_area` | varchar(255) | SÍ | Área |
| `product_package_wrap` | varchar(255) | NO | Tipo de empaque |
| `product_ref_qr` | varchar(255) | SÍ | Referencia QR |
| `product_expiration` | varchar(255) | NO | Fecha vencimiento |
| `product_type_process` | varchar(255) | SÍ | Tipo de proceso |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

## Módulo Auxiliar / Pruebas

### `informats`
Control de insumos de esterilización (indicadores, empaques, etc.).

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `insumo_name` | varchar(255) | NO | Nombre del insumo |
| `insumo_code` | varchar(255) | SÍ | Código del insumo |
| `insumo_type` | varchar(255) | SÍ | Tipo de insumo |
| `insumo_temp` | varchar(255) | NO | Temperatura de uso |
| `insumo_lot` | varchar(255) | NO | Número de lote |
| `insumo_exp` | date | NO | Fecha de vencimiento |
| `insumo_unit` | varchar(255) | NO | Unidad de medida |
| `insumo_status` | varchar(255) | NO | Estado (activo, agotado, etc.) |
| `insumo_quantity` | int | SÍ | Cantidad disponible |
| `insumo_note` | text | SÍ | Observaciones |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `instrumentals`
Trazabilidad individual de instrumental quirúrgico.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `product_id` | bigint unsigned | SÍ | FK → `products.id` (SET NULL) |
| `codigo_unico_ud` | varchar(255) | SÍ | Código único del instrumento — UNIQUE |
| `nombre_generico` | varchar(255) | SÍ | Nombre genérico |
| `tipo_familia` | varchar(255) | SÍ | Familia/tipo de instrumento |
| `marca_fabricante` | varchar(255) | SÍ | Marca/fabricante |
| `fecha_compra` | date | SÍ | Fecha de adquisición |
| `estado_actual` | varchar(255) | NO | Estado (default: `DISPONIBLE`) |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `lotes`
Registro de lotes por equipo de esterilización.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `lote_code` | varchar(255) | NO | Código del lote |
| `equipo_lote` | varchar(255) | NO | Equipo asociado |
| `tipo_lote` | varchar(255) | NO | Tipo de lote |
| `tipo_equipo` | varchar(255) | NO | Tipo de equipo |
| `status_lote` | varchar(255) | NO | Estado del lote |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `testbds`
Registro de pruebas de indicador biológico (BD).

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `testbd_reference` | varchar(255) | NO | Referencia de la prueba |
| `machine_id` | bigint unsigned | SÍ | FK → `machines.id` (SET NULL) |
| `machine_name` | varchar(255) | NO | Nombre del equipo |
| `lote_machine` | varchar(255) | NO | Lote del equipo |
| `temp_machine` | varchar(255) | NO | Temperatura del equipo |
| `lote_bd` | varchar(255) | NO | Lote del indicador biológico |
| `validation_bd` | varchar(255) | SÍ | Resultado de validación |
| `temp_ambiente` | varchar(255) | NO | Temperatura ambiente |
| `operator` | varchar(255) | SÍ | Operador |
| `observation` | varchar(255) | SÍ | Observaciones |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `testvacuums`
Registro de pruebas de vacío (Bowie-Dick).

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `testvacuum_reference` | varchar(255) | NO | Referencia de la prueba |
| `machine_id` | bigint unsigned | SÍ | FK → `machines.id` (SET NULL) |
| `machine_name` | varchar(255) | NO | Nombre del equipo |
| `lote_machine` | varchar(255) | NO | Lote del equipo |
| `tipo_equipo` | varchar(255) | NO | Tipo de equipo |
| `temp_ambiente` | varchar(255) | NO | Temperatura ambiente |
| `validation_vacuum` | varchar(255) | SÍ | Resultado de validación |
| `operator` | varchar(255) | SÍ | Operador |
| `observation` | varchar(255) | SÍ | Observaciones |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

## Módulo Sistema / Auth

### `users`
Usuarios del sistema.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `name` | varchar(255) | NO | Nombre completo |
| `email` | varchar(255) | NO | Email — UNIQUE |
| `email_verified_at` | timestamp | SÍ | Fecha de verificación |
| `password` | varchar(255) | NO | Contraseña (hash) |
| `is_active` | tinyint(1) | NO | Activo (1) / Inactivo (0) |
| `remember_token` | varchar(100) | SÍ | Token de sesión |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `roles`
Roles del sistema (Spatie Permission).

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `name` | varchar(255) | NO | Nombre del rol — UNIQUE con guard |
| `guard_name` | varchar(255) | NO | Guard de autenticación |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `permissions`
Permisos del sistema (Spatie Permission).

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `name` | varchar(255) | NO | Nombre del permiso — UNIQUE con guard |
| `guard_name` | varchar(255) | NO | Guard de autenticación |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `model_has_roles`
Pivot: asignación de roles a usuarios.

| Campo | Tipo | Descripción |
|---|---|---|
| `role_id` | bigint unsigned | FK → `roles.id` (CASCADE) |
| `model_type` | varchar(255) | Tipo del modelo (App\Models\User) |
| `model_id` | bigint unsigned | ID del modelo |

---

### `model_has_permissions`
Pivot: asignación directa de permisos a usuarios.

| Campo | Tipo | Descripción |
|---|---|---|
| `permission_id` | bigint unsigned | FK → `permissions.id` (CASCADE) |
| `model_type` | varchar(255) | Tipo del modelo |
| `model_id` | bigint unsigned | ID del modelo |

---

### `role_has_permissions`
Pivot: permisos asignados a roles.

| Campo | Tipo | Descripción |
|---|---|---|
| `permission_id` | bigint unsigned | FK → `permissions.id` (CASCADE) |
| `role_id` | bigint unsigned | FK → `roles.id` (CASCADE) |

---

### `licence_expirations`
Control de la licencia de uso de la aplicación.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `license_expiration_date` | date | SÍ | Fecha de vencimiento de la licencia |
| `license_notification_enabled` | tinyint(1) | NO | Notificación activa (default: 1) |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `media`
Archivos multimedia (Spatie MediaLibrary).

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `model_type` | varchar(255) | NO | Tipo del modelo asociado |
| `model_id` | bigint unsigned | NO | ID del modelo asociado |
| `uuid` | char(36) | SÍ | UUID único — UNIQUE |
| `collection_name` | varchar(255) | NO | Colección |
| `name` | varchar(255) | NO | Nombre del archivo |
| `file_name` | varchar(255) | NO | Nombre del archivo físico |
| `mime_type` | varchar(255) | SÍ | Tipo MIME |
| `disk` | varchar(255) | NO | Disco de almacenamiento |
| `conversions_disk` | varchar(255) | SÍ | Disco de conversiones |
| `size` | bigint unsigned | NO | Tamaño en bytes |
| `manipulations` | json | NO | Manipulaciones |
| `custom_properties` | json | NO | Propiedades personalizadas |
| `generated_conversions` | json | NO | Conversiones generadas |
| `responsive_images` | json | NO | Imágenes responsivas |
| `order_column` | int unsigned | SÍ | Orden |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

### `uploads`
Registro de archivos subidos al sistema.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `folder` | varchar(255) | NO | Carpeta de destino |
| `filename` | varchar(255) | NO | Nombre del archivo |
| `created_at` | timestamp | SÍ | |
| `updated_at` | timestamp | SÍ | |

---

## Laravel Interno

### `failed_jobs`
Cola de trabajos fallidos de Laravel.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `id` | bigint unsigned | NO | PK auto-incremental |
| `uuid` | varchar(255) | NO | UUID — UNIQUE |
| `connection` | text | NO | Conexión |
| `queue` | text | NO | Cola |
| `payload` | longtext | NO | Payload |
| `exception` | longtext | NO | Excepción |
| `failed_at` | timestamp | NO | Fecha/hora del fallo |

---

### `migrations`
Historial de migraciones de Laravel.

| Campo | Tipo | Descripción |
|---|---|---|
| `id` | int unsigned | PK auto-incremental |
| `migration` | varchar(255) | Nombre de la migración |
| `batch` | int | Número de lote |

---

### `password_resets`
Tokens para restablecimiento de contraseña.

| Campo | Tipo | Nulo | Descripción |
|---|---|---|---|
| `email` | varchar(255) | NO | Email del usuario |
| `token` | varchar(255) | NO | Token de restablecimiento |
| `created_at` | timestamp | SÍ | |

---

## Relaciones Principales (FK)

```
institutes          (referencia datos del hospital)
users               ←── model_has_roles ──→ roles
roles               ←── role_has_permissions ──→ permissions

areas ──→ receptions ──→ preparations ──→ labelqrs ──→ discharges ──→ stocks ──→ expeditions
               │               │               │              │           │
         reception_details  preparation_   labelqr_       discharge_  stock_
                            details        details        details     details
                               │
                    preparation_quantity_resets

products ──→ categories
products ──→ instrumentals
machines ──→ testbds
machines ──→ testvacuums
```
