<template>
  <input
      type="submit"
      class="btn btn-danger d-block w-100 mb-1"
      value="Eliminar"
      v-on:click="eliminarReceta"
  >
</template>


<script>
export default {
  props: ['recetaId'],
  methods: {
    eliminarReceta() {
      this.$swal({
        title: 'Deseas eliminar la receta?',
        text: "Una vez eliminada no se podrá recuperar!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          const params = {
            id: this.recetaId
          }
          //Enviamos la peticion al servidor
          axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'})
              .then(resp => {

                this.$swal({
                  title: 'Receta Eliminada',
                  text: 'Se elimino la receta',
                  icon: 'success'
                })

                //Eliminar receta del DOM
                console.log(this.$el)
                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);

              })
              .catch(error => {
                console.log(error)
              })


        }
      })
    }
  }

}
</script>