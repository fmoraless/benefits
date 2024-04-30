# Aplicación Beneficios

Se disponen 3 endpoints para la obtención de data:
- Beneficios
- Filtros
- Fichas

El endpoint beneficios, trae todos los beneficios de un usuario que ha recibido
por años, estos beneficios trae un monto y una fecha.

El endpoint filtros, trae la información de cada beneficio, en él podrás
encontrar los montos mínimos , máximos y el id de la ficha.

El endpoint Fichas, trae la información de una ficha en específico, cada
beneficio tiene una ficha.

La relación es: **un beneficio tiene un filtro y un filtro tiene una ficha.**

## Requerimientos

**1**. Beneficios ordenados por años.

**2**. Monto total por año.

**3**. Número de beneficios por año.

**4**. Filtrar solo los beneficios que cumplan los montos máximos y mínimos.

**5**. Cada beneficio debe traer su ficha.

**6**. Se debe ordenar por año, de mayor a menor.

## Requisitos Previos

Asegúrate de tener instalado PHP y Composer en tu sistema.
```
composer --version

Composer version 2.7.4 2024-04-22 21:17:03
PHP version 8.3.6 (/usr/bin/php8.3) #desde 8.1 en adelante
```

```
Servidor apache
Puede ser con Xampp, Laragon, o utilizando Docker(wsl)
```

## Pasos para Poner en Marcha

Clonar projecto

```bash
  git clone https://github.com/fmoraless/benefits.git
```

Ir al directorio del proyecto

```bash
  cd benefits
```

Instalar dependencias

```bash
  composer install
```



## Environment

Renombra el archivo .env.example a .env y setear tus variables de entorno.
para generar el `APP_KEY`
utiliza el comando:
```bash
php artisan key:generate
```

Iniciar proyecto con artisan

```bash
  php artisan serve
```



## Ejemplo de uso

```bash
mediante postman o en tu navegador accede a la ruta 'http://127.0.0.1/api/v1/benefits'

La respuesta esperada es la siguiente:
{
"data": [
    {
    "year": 2023,
    "num": 8,
    "totalByYear": 295608,
    "beneficios": [
        {
            "id_programa": 147,
            "monto": 40656,
            "fecha_recepcion": "09/11/2023",
            "fecha": "2023-11-09",
            "ficha": {
                "id": 922,
                "nombre": "Emprende",
                "id_programa": 147,
                "url": "emprende",
                "categoria": "trabajo",
                "descripcion": "Fondos concursables para nuevos negocios"
            }
        },
        {
        "id_programa": 130,
        "monto": 40656,
        "fecha_recepcion": "08/09/2023",
        "fecha": "2023-09-08",
            "ficha": {
            "id": 2042,
                "nombre": "Subsidio Familiar (SUF)",
                "id_programa": 130,
                "url": "subsidio_familiar_suf",
                "categoria": "bonos",
                "descripcion": "Beneficio económico mensual entregado a madres, padres o tutores que no cuentan con previsión social."
            }
        },
... mored data
```


## Postman

[Link Postman](https://drive.google.com/file/d/1VH7mtjk5vaAUU2feGEa7Q09x0yQZ-IVO/view?usp=sharing)


## Running Tests

Para correr los tests ejecutar en consola

```bash
  php artisan test
```


## Screenshots


#### Ejecución de tests
![Tests](https://drive.google.com/uc?id=1FVtBf_u3bbG5u-9a7CDxXYS7pgR49KLq)

#### Respuesta
![Response](https://drive.google.com/uc?id=1HkZ-O1y4sWWQ53osYBJisPGYfdMyzliI)


## Contributing

¡Contribuciones son bienvenidas!
Si encuentras problemas o tienes mejoras, por favor crea un issue o envía un pull request.


## Authors

- Francisco Morales [@fmoraless](https://www.github.com/fmoraless)


