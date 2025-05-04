document.addEventListener('DOMContentLoaded', function() {
    // Verificar si estamos en la página de listado
    if (document.getElementById('postsContainer')) {
        loadPosts();
    }
    
    // Verificar si estamos en la página de creación de posts
    if (document.getElementById('postForm')) {
        setupFormValidation();
        setupImagePreview();
    }
    
    // Verificar si hay un mensaje de éxito en la URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('msg')) {
        const msg = urlParams.get('msg');
        if (msg === 'success') {
            showAlert('Post creado exitosamente', 'success');
        }
    }
    
    // Verificar si hay un mensaje de error de login
    if (urlParams.has('error')) {
        const error = urlParams.get('error');
        if (error === 'auth_required') {
            showAlert('Debes iniciar sesión para acceder a esta página', 'warning');
        } else if (error === 'invalid_credentials') {
            showAlert('Usuario o contraseña incorrectos', 'danger');
        } else if (error === 'empty_fields') {
            showAlert('Por favor completa todos los campos', 'warning');
        }
    }
    
    // Verificar si el login fue exitoso
    if (urlParams.has('login') && urlParams.get('login') === 'success') {
        showAlert('Has iniciado sesión correctamente', 'success');
    }
});

// Función para cargar los posts desde el servidor
function loadPosts() {
    const postsContainer = document.getElementById('postsContainer');
    
    // Mostrar indicador de carga
    postsContainer.innerHTML = '<div class="text-center w-100"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></div>';
    
    // Realizar petición AJAX para obtener los posts
    fetch('/web/semanas/semana8/backend/api/get_posts.php')
        .then(response => {
            console.log('Respuesta recibida:', response.status);
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Error en la respuesta:', text);
                    throw new Error('Error al cargar los posts');
                });
            }
            return response.json();
        })
        .then(posts => {
            console.log('Posts recibidos:', posts);
            // Limpiar el contenedor
            postsContainer.innerHTML = '';
            
            if (posts.length === 0) {
                postsContainer.innerHTML = '<div class="col-12 text-center"><p class="text-muted">No hay publicaciones disponibles.</p></div>';
                return;
            }
            
            // Crear tarjetas para cada post
            posts.forEach(post => {
                const postCard = createPostCard(post);
                postsContainer.appendChild(postCard);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            postsContainer.innerHTML = `<div class="col-12 text-center"><p class="text-danger">Error al cargar las publicaciones: ${error.message}</p></div>`;
        });
}

// Función para crear una tarjeta de post
function createPostCard(post) {
    const col = document.createElement('div');
    col.className = 'col-md-4 mb-4';
    
    const card = document.createElement('div');
    card.className = 'card h-100 shadow';
    
    // Imagen del post (si existe)
    if (post.image) {
        const img = document.createElement('img');
        img.src = post.image;
        img.className = 'card-img-top';
        img.alt = post.title;
        img.style.height = '200px';
        img.style.objectFit = 'cover';
        card.appendChild(img);
    }
    
    const cardBody = document.createElement('div');
    cardBody.className = 'card-body d-flex flex-column';
    
    const title = document.createElement('h5');
    title.className = 'card-title';
    title.textContent = post.title;
    cardBody.appendChild(title);
    
    const category = document.createElement('span');
    category.className = 'badge bg-primary mb-2';
    category.textContent = post.category;
    cardBody.appendChild(category);
    
    const excerpt = document.createElement('p');
    excerpt.className = 'card-text';
    // Limitar el texto a 100 caracteres
    excerpt.textContent = post.body.length > 100 ? post.body.substring(0, 100) + '...' : post.body;
    cardBody.appendChild(excerpt);
    
    const meta = document.createElement('p');
    meta.className = 'card-text text-muted mt-auto small';
    
    // Formatear fecha
    const date = new Date(post.created_at);
    const formattedDate = date.toLocaleDateString('es-ES', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    
    meta.textContent = `Por ${post.author} • ${formattedDate}`;
    cardBody.appendChild(meta);
    
    // Botón para ver post completo
    const link = document.createElement('a');
    link.href = `view.html?id=${post.id}`;
    link.className = 'btn btn-outline-primary mt-2';
    link.textContent = 'Leer más';
    cardBody.appendChild(link);
    
    card.appendChild(cardBody);
    col.appendChild(card);
    
    return col;
}

// Función para configurar la validación del formulario
function setupFormValidation() {
    const form = document.getElementById('postForm');
    
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        form.classList.add('was-validated');
    });
}

// Función para configurar la previsualización de imagen
function setupImagePreview() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    
    if (imageInput && imagePreview && imagePreviewContainer) {
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.classList.remove('d-none');
                };
                
                reader.readAsDataURL(this.files[0]);
            } else {
                imagePreviewContainer.classList.add('d-none');
            }
        });
    }
}

// Función para mostrar alertas
function showAlert(message, type = 'info') {
    const alertContainer = document.createElement('div');
    alertContainer.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4`;
    alertContainer.setAttribute('role', 'alert');
    alertContainer.style.zIndex = '1050';
    
    alertContainer.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    document.body.appendChild(alertContainer);
    
    // Eliminar la alerta después de 5 segundos
    setTimeout(() => {
        alertContainer.remove();
    }, 10000);   
  
    // Agregar el botón de cierre
    const closeButton = alertContainer.querySelector('.btn-close');
    closeButton.addEventListener('click', () => {
        alertContainer.remove();
    });
}
