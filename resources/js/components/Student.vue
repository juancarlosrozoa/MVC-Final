<template>
  <div>
    <h1 class="text-center">Tecnologia en desarrollo de software</h1>
    <h2 class="text-center">Materias</h2>
    <hr>
    <br>

<!-- dropdown -->
  <div>
    <select name="select_semestre" @change="onChange($event)" class="form-select form-control">
        <option>---- Seleccione semestre ----</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        
    </select>

  </div>
  <br>

      <!-- card -->
    <div  class="row">

      <div  v-for="subject in subjects" :key="subject.id" class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title text-center">{{ subject.nombre }}</h5>
          <button @click="update=true; openModal(subject);" class="btn btn-primary text-center">Detalles</button>
        </div>
      </div>
    </div>

    <!-- Modal -->
      <div class="modal" :class="{show:modal}" >
      <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">{{ titleModal }}</h5>
          <!-- <span aria-hidden="true">&times;</span>
          <span aria-hidden="true">&times;</span> -->
              <button @click="closeModal();" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><!-- <span aria-hidden="true">&times;</span> --></button>
          </div>
          <div class="modal-body">
                          
              <div>
                  <label for="creditos">Creditos</label>
                  <input v-model="subject.creditos" type="text" class="form-control" id="creditos" placeholder="Creditos de la materia">
              </div>
              <div>
                  <label for="docente">Docente</label>
                  <input v-model="subject.docente" type="text" class="form-control" id="docente" placeholder="Nombre del docente">
              </div>
              <div>
                  <label for="prerrequisito">Prerrequisito</label>
                  <input v-model="subject.prerrequisito" type="text" class="form-control" id="prerrequisito" placeholder="Prerrequisito de la materia">
              </div>
              <div>
                  <label for="htrabajoautonomo">Horas de trabajo autonomo</label>
                  <input v-model="subject.htrabajoautonomo" type="text" class="form-control" id="htrabajoautonomo" placeholder="Horas de trabajo autonomo">
              </div>
              <div>
                  <label for="htrabajodirigido">Horas de trabajo dirigido</label>
                  <input v-model="subject.htrabajodirigido" type="text" class="form-control" id="htrabajodirigido" placeholder="Horas de trabajo dirigido">
              </div>
          </div>
          <div class="modal-footer">
              <button @click="closeModal();" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              
          </div>
          </div>
      </div>
      </div>

  </div>
  
</template>

<script>
    export default {
        data (){
            return {
                subject: {
                    semestre:'', 
                    nombre:'', 
                    creditos:'', 
                    docente:'', 
                    prerrequisito:'', 
                    htrabajoautonomo:'', 
                    htrabajodirigido:''
                },

                id:0,
                update:true,
                modal:0,
                titleModal:'',
                subjects:[],
            }
        },
        methods: {
            async list(){
                const res = await axios.get('subjects');
                this.subjects=res.data;
            },
            async eliminar(id){
                const res = await axios.delete('/subjects/'+id);
                this.list();
            },
            async save(){
                if(this.update){
                    const res = await axios.put('/subjects/' + this.id, this.subject);

                }else{
                    const res = await axios.post('/subjects',this.subject);
                }
                this.closeModal();
                this.list();
            },
            openModal(data={}){
                this.modal=1;
                if(this.update){
                    this.id=data.id,
                    this.titleModal="Detalle Materia";
                    this.subject.semestre=data.semestre;
                    this.subject.nombre=data.nombre;
                    this.subject.creditos=data.creditos;
                    this.subject.docente=data.docente;
                    this.subject.prerrequisito=data.prerrequisito;
                    this.subject.htrabajoautonomo=data.htrabajoautonomo;
                    this.subject.htrabajodirigido=data.htrabajodirigido;
                }
            },
            closeModal(){
                this.modal=0;
            },
        },
        created(){
            this.list();
        },
    }
</script> 
<style>
.show{
    display: list-item;
    opacity: 1;
    background: rgba(44, 38, 75, 0.849);
}
</style>