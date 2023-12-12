<template>
  <nav id="nav" class="navbar navbar-expand-lg sticky-top" data-bs-theme="dark">
    <div class="container">
      <router-link to="/" class="navbar-brand">ToDo App</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li>
            <router-link to="/" class="nav-link">Accueil</router-link>
          </li>
          <li>
            <router-link to="/hello" class="nav-link">Hello</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
