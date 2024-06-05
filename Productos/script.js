document.addEventListener("DOMContentLoaded", function () {
    const btnMostrarCarrito = document.getElementById("btnMostrarCarrito");
    const carritoMenu = document.getElementById("carrito");
    const productosCarrito = document.getElementById("productos-carrito");

    carritoMenu.style.display = "none";

    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    function actualizarCarrito() {
        productosCarrito.innerHTML = '';
        let total = 0;

        carrito.forEach((producto, index) => {
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

            total += parseFloat(producto.precio);

            productoDiv.querySelector(".btn-eliminar").addEventListener("click", function () {
                carrito.splice(index, 1);
                localStorage.setItem('carrito', JSON.stringify(carrito));
                actualizarCarrito();
            });
        });

        const totalDiv = document.createElement("div");
        totalDiv.classList.add("total");
        totalDiv.innerHTML = `<h3>Total: €${total.toFixed(2)}</h3>`;
        productosCarrito.appendChild(totalDiv);
    }

    actualizarCarrito();

    btnMostrarCarrito.addEventListener("click", function () {
        carritoMenu.style.display = carritoMenu.style.display === "none" || carritoMenu.style.display === "" ? "block" : "none";
    });

    window.addToCart = function (event, nombre, precio, foto) {
        event.preventDefault();

        const producto = { nombre, precio: parseFloat(precio), foto };
        carrito.push(producto);
        localStorage.setItem('carrito', JSON.stringify(carrito));

        alert('Producto añadido al carrito');
        actualizarCarrito();
    };
});
