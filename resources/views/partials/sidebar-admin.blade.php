

<section class="sidebar-section">
    <div class="sidebar-header">
        {{-- <h1>INAH</h1> --}}
        <img src="{{asset('img/uploads/logo_inah.png')}}" alt="logo">
    </div>
    <hr>
    <div class="dashboard-hamburger">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M666-440 440-666l226-226 226 226-226 226Zm-546-80v-320h320v320H120Zm400 400v-320h320v320H520Zm-400 0v-320h320v320H120Zm80-480h160v-160H200v160Zm467 48 113-113-113-113-113 113 113 113Zm-67 352h160v-160H600v160Zm-400 0h160v-160H200v160Zm160-400Zm194-65ZM360-360Zm240 0Z"/></svg>
        <span>TABLAS</span>
    </div>
    <hr>
    <div class="menu-tablas">
        <h3>GESTIÓN</h3>
        <div class="tables-link">
            {{-- USUARIOS --}}
            <details>
                <summary>Usuarios</summary>
                <div class="tables-actions">
                    <span>Operaciones</span>
                    <a href="">Eliminar</a>
                </div>
            </details>
            {{-- ESTADOS --}}
            <details>
                <summary>Estados</summary>
                <div class="tables-actions">
                    <span>Operaciones</span>
                    <a href="">Agregar</a>
                    <a href="">Eliminar</a>
                    <a href="">Editar</a>
                </div>
            </details>
            {{-- ZONAS --}}
            <details>
                <summary>Zonas</summary>
                <div class="tables-actions">
                    <span>Operaciones</span>
                    <a href="">Agregar</a>
                    <a href="">Eliminar</a>
                    <a href="">Editar</a>
                </div>
            </details>
            {{-- CULTURAS --}}
            <details>
                <summary>Culturas</summary>
                <div class="tables-actions">
                    <span>Operaciones</span>
                    <a href="">Agregar</a>
                    <a href="">Eliminar</a>
                    <a href="">Editar</a>
                </div>
            </details>
            {{-- RESEÑAS --}}
            <details>
                <summary>Reseñas</summary>
                <div class="tables-actions">
                    <span>Operaciones</span>
                    <a href="">Eliminar</a>
                </div>
            </details>
            {{-- UBICACIONES --}}
            <details>
                <summary>Ubicaciones</summary>
                <div class="tables-actions">
                    <span>Operaciones</span>
                    <a href="">Eliminar</a>
                </div>
            </details>
        </div>
    </div>
    <hr>
    <div class="acceso-tablas">
        <a href="{{route('database')}}">
            <span>DATA BASE</span>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-120q-151 0-255.5-46.5T120-280v-400q0-66 105.5-113T480-840q149 0 254.5 47T840-680v400q0 67-104.5 113.5T480-120Zm0-479q89 0 179-25.5T760-679q-11-29-100.5-55T480-760q-91 0-178.5 25.5T200-679q14 30 101.5 55T480-599Zm0 199q42 0 81-4t74.5-11.5q35.5-7.5 67-18.5t57.5-25v-120q-26 14-57.5 25t-67 18.5Q600-528 561-524t-81 4q-42 0-82-4t-75.5-11.5Q287-543 256-554t-56-25v120q25 14 56 25t66.5 18.5Q358-408 398-404t82 4Zm0 200q46 0 93.5-7t87.5-18.5q40-11.5 67-26t32-29.5v-98q-26 14-57.5 25t-67 18.5Q600-328 561-324t-81 4q-42 0-82-4t-75.5-11.5Q287-343 256-354t-56-25v99q5 15 31.5 29t66.5 25.5q40 11.5 88 18.5t94 7Z"/></svg>
        </a>
    </div>
</section>
