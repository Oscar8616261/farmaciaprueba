<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre',length:80);
            $table->string('telefono',length:30);
            $table->string('turno',length:80);
            $table->string('usuario',length:80)->unique();
            $table->string('contrasena',length:255);
            $table->enum('rol', ['administrador', 'farmaceutico']);
            $table->timestamps();
        });
        
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('nombre',length:80);
            $table->string('telefono',length:30);
            $table->string('ci',length:30)->unique();
            $table->string('direccion',length:50);
            $table->timestamps();
        });

        Schema::create('proveedor', function (Blueprint $table) {
            $table->id('id_proveedor');
            $table->string('nombre',length:80);
            $table->enum('tipo', ['distribuidora', 'individual']);
            $table->string('telefono',length:30);
            $table->integer('diasCambioAntesVencimiento');
            $table->timestamps();
        });

        Schema::create('presentacion', function (Blueprint $table) {
            $table->id('id_presentacion');
            $table->string('tipoPresentacion',length:80);
            $table->string('codigo',length:30)->unique();
            $table->timestamps();
        });

        Schema::create('tipo', function (Blueprint $table) {
            $table->id('id_tipo');
            $table->string('foto',length:80);
            $table->string('nombre',length:80);
            $table->timestamps();
        });

        Schema::create('producto', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre',length:80);
            $table->string('foto',length:80)->nullable();
            $table->unsignedBigInteger('id_tipo');
            $table->decimal('precioCompra',total:8,places:2);
            $table->decimal('precioVenta',total:8,places:2);
            $table->integer('descuento')->default(0);
            $table->integer('stock')->default(0);
            $table->integer('stockMinimo');
            $table->enum('estado', ['activo', 'inactivo']);
            $table->date('fechaVencimiento')->nullable();
            $table->enum('controlado', ['si', 'no']);
            $table->unsignedBigInteger('id_proveedor')->nullable();
            $table->unsignedBigInteger('id_presentacion')->nullable();
            $table->timestamps();

            $table->foreign('id_tipo')->references('id_tipo')->on('tipo');
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedor');
            $table->foreign('id_presentacion')->references('id_presentacion')->on('presentacion');
        });

        Schema::create('pedido', function (Blueprint $table) {
            $table->id('id_pedido');
            $table->date('fecha');
            $table->decimal('total',total:8,places:2);
            $table->unsignedBigInteger('id_proveedor');
            $table->enum('estado', ['pendiente', 'recibido']);
            $table->timestamps();
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedor');
        });


        Schema::create('detalle_pedido', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->unsignedBigInteger('id_pedido');
            $table->unsignedBigInteger('id_producto');
            $table->decimal('precio_unitario',total:8,places:2);
            $table->integer('cantidad')->default(0);
            $table->decimal('subtotal',total:8,places:2);
            $table->timestamps();

            $table->foreign('id_pedido')->references('id_pedido')->on('pedido');
            $table->foreign('id_producto')->references('id_producto')->on('producto');
        });

        Schema::create('devolucion', function (Blueprint $table) {
            $table->id('id_devolucion');
            $table->date('fecha');
            $table->string('motivo',length:80);
            $table->unsignedBigInteger('id_proveedor');
            $table->enum('estado', ['pendiente', 'recibido']);
            $table->timestamps();
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedor');
        });


        Schema::create('detalle_devolucion', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->unsignedBigInteger('id_devolucion');
            $table->unsignedBigInteger('id_producto');
            $table->decimal('precio_unitario',total:8,places:2);
            $table->integer('cantidad')->default(0);
            $table->decimal('subtotal',total:8,places:2);
            $table->timestamps();
            
            $table->foreign('id_devolucion')->references('id_devolucion')->on('devolucion');
            $table->foreign('id_producto')->references('id_producto')->on('producto');
        });


        Schema::create('pago', function (Blueprint $table) {
            $table->id('id_pago');
            $table->string('nombre',length:80);
            $table->timestamps();
        });
        
        Schema::create('receta', function (Blueprint $table) {
            $table->id('id_receta');
            $table->date('fechaEmision');
            $table->string('nombreDoctor',length:80);
            $table->string('diagnostico',length:80);
            $table->timestamps();
        });


        Schema::create('venta', function (Blueprint $table) {
            $table->id('id_venta');
            $table->date('fecha');
            $table->decimal('total',total:8,places:2);
            $table->enum('tipoVEnta', ['libre', 'controlado']);
            $table->unsignedBigInteger('id_receta')->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_pago');
            $table->enum('estado', ['pendiente', 'pagado', 'anulado']);
            $table->timestamps();

            $table->foreign('id_receta')->references('id_receta')->on('receta');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente');
            $table->foreign('id_pago')->references('id_pago')->on('pago');
        });


        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->unsignedBigInteger('id_venta');
            $table->unsignedBigInteger('id_producto');
            $table->decimal('precio_unitario',total:8,places:2);
            $table->integer('cantidad')->default(0);
            $table->decimal('subtotal',total:8,places:2);
            $table->timestamps();

            $table->foreign('id_venta')->references('id_venta')->on('venta');
            $table->foreign('id_producto')->references('id_producto')->on('producto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
