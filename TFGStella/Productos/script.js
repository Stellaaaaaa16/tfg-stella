document.addEventListener("DOMContentLoaded", function () {
    const btnMostrarCarrito = document.getElementById("btnMostrarCarrito");
    const carritoMenu = document.getElementById("carrito");
    const productosCarrito = document.getElementById("productos-carrito");

    // no se muestre en la pagina el carrito 
    carritoMenu.style.display = "none";

    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    // actualiza el carrito 
    function actualizarCarrito() {
        // pone a 0 el carrito
        productosCarrito.innerHTML = '';
        let total = 0;

        // Rse muestra la imformacion en el carrito
        carrito.forEach((producto, index) => {
            //detalles de los productos ¡ y un botón para eliminarlo
            const productoDiv = document.createElement("div");
            productoDiv.classList.add("producto-carrito");
            productoDiv.innerHTML = `
                <img src="${producto.foto}" alt="Producto">
                <div class="producto-info">
                    <h4>${producto.nombre}</h4>
                    <p>Precio: €<span class="precio">${producto.precio.toFixed(2)}</span></p>
                </div>
                <button class="btn-eliminar" data-index="${index}">Eliminar</button>
            `;
            productosCarrito.appendChild(productoDiv);

            // Suma el precio del producto al total
            total += parseFloat(producto.precio);

            // Añade un evento para eliminar el producto del carrito
            productoDiv.querySelector(".btn-eliminar").addEventListener("click", function () {
                carrito.splice(index, 1);
                localStorage.setItem('carrito', JSON.stringify(carrito));
                actualizarCarrito();
            });
        });

        // mostrar el total del carrito
        const totalDiv = document.createElement("div");
        totalDiv.classList.add("total");
        totalDiv.innerHTML = `<h3>Total: €${total.toFixed(2)}</h3>`;
        productosCarrito.appendChild(totalDiv);
    }

    actualizarCarrito();

    // si le das click al boton se muestra el carrito y viceversa 
    btnMostrarCarrito.addEventListener("click", function () {
        carritoMenu.style.display = carritoMenu.style.display === "none" || carritoMenu.style.display === "" ? "block" : "none";
    });

    // para poder añadir los productos al carrito 
    window.addToCart = function (event, nombre, precio, foto) {
        event.preventDefault();

        // información del producto y lo añade al carrito
        const producto = { nombre, precio: parseFloat(precio), foto };
        carrito.push(producto);
        localStorage.setItem('carrito', JSON.stringify(carrito));

        alert('Producto añadido al carrito');
        actualizarCarrito();
    };
});
