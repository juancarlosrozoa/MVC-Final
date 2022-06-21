<template>
    <div>
        <h1 class="text-center">Tecnología Desarrollo de Software</h1>
        <h2 class="text-center">Materias</h2>
        <hr>
        <!-- Button trigger modal -->
        <button @click="update=false; openModal();" type="button" class="btn btn-primary" >
        Adicionar materia
        </button>
        <hr>
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
                    <label for="semestre">Semestre</label>
                    <input v-model="subject.semestre" type="text" class="form-control" id="semestre" placeholder="Semestre">
                </div>
                <div>
                    <label for="nombre">Materia</label>
                    <input v-model="subject.nombre" type="text" class="form-control" id="nombre" placeholder="Materia">
                </div>
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
                <button @click="save();" type="button" class="btn btn-success">Guardar cambios</button>
            </div>
            </div>
        </div>
        </div>




        <table class="table  table-striped table-hover">
           <thead class="table-dark"> 
               <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Semestre</th>
                    <th scope="col">Materia</th>
                    <th scope="col">Creditos</th>
                    <th scope="col">Docente</th>
                    <th scope="col">Prerrequisito</th>
                    <th scope="col">Hora trabajo autonomo</th>
                    <th scope="col">Hora trabajo dirigido</th>
                    <th scope="col" colspan="2" class="text-center">Acción</th>
                </tr>
            </thead> 
            <tbody>
                <tr v-for="subject in subjects" :key="subject.id">
                    <th scope="row">{{ subject.id }}</th>
                    <td>{{ subject.semestre }}</td>
                    <td>{{ subject.nombre }}</td>
                    <td>{{ subject.creditos }}</td>
                    <td>{{ subject.docente }}</td>
                    <td>{{ subject.prerrequisito }}</td>
                    <td>{{ subject.htrabajoautonomo }}</td>
                    <td>{{ subject.htrabajodirigido }}</td>
                    <td>
                        <button @click="update=true; openModal(subject);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(subject.id)" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        
                       
            
        </table>
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
                    this.titleModal="Modificar Materia";
                    this.subject.semestre=data.semestre;
                    this.subject.nombre=data.nombre;
                    this.subject.creditos=data.creditos;
                    this.subject.docente=data.docente;
                    this.subject.prerrequisito=data.prerrequisito;
                    this.subject.htrabajoautonomo=data.htrabajoautonomo;
                    this.subject.htrabajodirigido=data.htrabajodirigido;

                }else{
                    this.id=0,
                    this.titleModal="Crear materia";
                    this.subject.semestre='';
                    this.subject.nombre='';
                    this.subject.creditos='';
                    this.subject.docente='';
                    this.subject.prerrequisito='';
                    this.subject.htrabajoautonomo='';
                    this.subject.htrabajodirigido='';
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