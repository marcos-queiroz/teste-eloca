<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <router-link to="/" class="navbar-brand">
                <img src="https://d1zmtoblzb5ysp.cloudfront.net/243b9233-0a4a-421a-884c-906571e3240a/images/eloca_logo_pequena.webp"
                    class="img-fluid" alt="Eloca" width="120">
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link" active-class="active" exact>
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/empresa" class="nav-link" active-class="active">
                            Empresas
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/cliente" class="nav-link" active-class="active">
                            Clientes
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'NavBar'
}
</script>

<style scoped></style>
