<template>
  <div class="row g-2 align-items-center" id="searchBar">
    <div class="col-auto">
      <input
        type="text"
        class="form-control"
        v-model="query"
        placeholder="upload fichiers, courses,... "
      />
    </div>
    <div class="col-auto">
      <button class="btn btn-light" @click="applyFilter">Rechercher</button>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  data() {
    return {
      query: "",
    };
  },

  // intégrer un watcher qui lance le filtre dès que la query change
  watch: {
    query: function () {
      this.applyFilter();
    },
  },

  methods: {
    applyFilter() {
      this.$emit("apply-filter", this.query);
    },
  },
};
</script>
