<template>
  <div class="container">
    <p>hola</p>
    <form @submit.prevent="editarNota(nota)" v-if="modoEditar">
      <h3>Editar nota</h3>
      <input
        type="text"
        class="form-control mb-2"
        placeholder="Nombre de la nota"
        v-model="nota.nombre"
      />
      <input
        type="text"
        class="form-control mb-2"
        placeholder="Descripción de la nota"
        v-model="nota.descripcion"
      />
      <button class="btn btn-warning" type="submit">Editar</button>
      <button class="btn btn-danger" type="submit" @click="cancelarEdicion">Cancelar</button>
    </form>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
   data() {
    return {
      notas: [],
      modoEditar: true,
      nota: {nombre: '', descripcion: ''}
    }
  },
  created(){
    axios.get('/notas').then(res=>{
      this.notas = res.data;
    })
  },
  methods:{
    agregar(){
      if(this.nota.nombre.trim() === '' || this.nota.descripcion.trim() === ''){
        alert('Debes completar todos los campos antes de guardar');
        return;
      }
      const notaNueva = this.nota;
      this.nota = {nombre: '', descripcion: ''};    
      axios.post('/notas', notaNueva)
        .then((res) =>{
          const notaServidor = res.data;
          this.notas.push(notaServidor);
        })
    },
    editarFormulario(item){
      this.nota.nombre = item.nombre;
      this.nota.descripcion = item.descripcion;
      this.nota.id = item.id;
      this.modoEditar = true;
    },
    editarNota(nota){
      const params = {nombre: nota.nombre, descripcion: nota.descripcion};
      axios.put(`/notas/${nota.id}`, params)
        .then(res=>{
          this.modoEditar = false;
          const index = this.notas.findIndex(item => item.id === nota.id);
          this.notas[index] = res.data;
        })
    },
    eliminarNota(nota, index){
      const confirmacion = confirm(`Eliminar nota ${nota.nombre}`);
      if(confirmacion){
        axios.delete(`/notas/${nota.id}`)
          .then(()=>{
            this.notas.splice(index, 1);
          })
      }
    },
    cancelarEdicion(){
      this.modoEditar = false;
      this.nota = {nombre: '', descripcion: ''};
    }
  }
};
</script>
