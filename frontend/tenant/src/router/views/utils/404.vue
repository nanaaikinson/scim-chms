<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="text-center">
          <h3 class="display-4">
            Sorry, the page you're looking for cannot be found.
          </h3>
          <router-link
            tag="button"
            :to="{
              name: 'Dashboard'
            }"
            class="btn btn-primary mt-5"
          >
            Go Home
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>
