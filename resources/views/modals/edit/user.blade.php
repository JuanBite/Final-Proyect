<div x-data="editUserForm()" @load-user-data.window="loadUserData($event.detail)"
    class="bg-[#111D30] border border-green-500/20 rounded-3xl w-[560px] max-w-full shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">

    <!-- HEADER -->
    <div class="relative flex items-center gap-4 p-7 border-b border-green-500/20 bg-green-500/5 shrink-0">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-green-500 to-blue-400"></div>
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-700 to-green-400 flex items-center justify-center font-black text-sm text-black"
            x-text="(formData.nombre.charAt(0) + formData.apellido.charAt(0)).toUpperCase()">
        </div>
        <div>
            <div class="font-syne text-xl font-extrabold">
                Editar <span class="text-green-400" x-text="formData.nombre + ' ' + formData.apellido"></span>
            </div>
            <div class="text-sm text-gray-400" x-text="formData.email"></div>
        </div>
        <div
            class="ml-auto mr-10 flex items-center gap-2 bg-green-500/10 border border-green-500/30 px-3 py-1 rounded text-xs text-green-400">
            ● Modo edición
        </div>
        <button @click="$dispatch('close-edit-modal'); document.body.style.overflow='';"
            class="absolute top-5 right-5 w-8 h-8 bg-[#182236] border border-green-500/20 rounded flex items-center justify-center text-gray-400 hover:text-white transition-all cursor-pointer">
            ✕
        </button>
    </div>

    <!-- BODY -->
    <div class="p-6 overflow-y-auto flex-1">

        <!-- PROFILE -->
        <div class="flex items-center gap-4 bg-green-500/10 border border-green-500/30 rounded-xl p-4 mb-6">
            <div class="w-12 h-12 flex items-center justify-center rounded-xl font-bold bg-gradient-to-br from-green-700 to-green-400 text-black"
                x-text="(formData.nombre.charAt(0) + formData.apellido.charAt(0)).toUpperCase()">
            </div>
            <div class="flex-1">
                <div class="font-syne font-bold" x-text="formData.nombre + ' ' + formData.apellido"></div>
                <div class="text-xs text-gray-400" x-text="formData.email"></div>
            </div>
            <div class="text-xs bg-green-500/10 text-green-400 px-3 py-1 rounded-full border border-green-500/30">
                ● <span
                    x-text="formData.role === 'INSTRUCTOR' ? 'Líder de Proyecto' : formData.role === 'STUDENT' ? 'Miembro' : 'Admin'"></span>
            </div>
        </div>

        <!-- DATOS -->
        <div class="text-[10px] uppercase tracking-widest text-gray-400 mb-3 flex items-center gap-2">
            Datos personales <div class="flex-1 h-px bg-green-500/20"></div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <input x-model="formData.nombre"
                class="col-span-1 bg-[#182236] border border-green-500/20 rounded-lg p-3 text-sm focus:border-green-500/50 outline-none"
                placeholder="Nombre">
            <input x-model="formData.apellido"
                class="col-span-1 bg-[#182236] border border-green-500/20 rounded-lg p-3 text-sm focus:border-green-500/50 outline-none"
                placeholder="Apellido">
            <input x-model="formData.email"
                class="col-span-2 bg-[#182236] border border-green-500/20 rounded-lg p-3 text-sm focus:border-green-500/50 outline-none"
                placeholder="Correo electrónico">
        </div>

        <!-- ROLES -->
        <div class="grid grid-cols-3 gap-2 mb-6">
            <div @click="formData.role = 'INSTRUCTOR'"
                :class="formData.role === 'INSTRUCTOR' ? 'border-green-500/30 bg-green-500/10' : 'border-green-500/20 bg-[#182236]'"
                class="text-center p-3 rounded-xl border cursor-pointer">
                🎯
                <div class="font-syne text-sm text-green-400">INSTRUCTOR</div>
                <div class="text-xs text-gray-400">Gestiona</div>
            </div>
            <div @click="formData.role = 'STUDENT'"
                :class="formData.role === 'STUDENT' ? 'border-blue-500/30 bg-blue-500/10' : 'border-green-500/20 bg-[#182236]'"
                class="text-center p-3 rounded-xl border cursor-pointer">
                👤
                <div class="font-syne text-sm text-blue-400">STUDENT</div>
                <div class="text-xs text-gray-400">Participa</div>
            </div>
            <div @click="formData.role = 'ADMIN'"
                :class="formData.role === 'ADMIN' ? 'border-yellow-500/30 bg-yellow-500/10' : 'border-green-500/20 bg-[#182236]'"
                class="text-center p-3 rounded-xl border cursor-pointer">
                ⚙️
                <div class="font-syne text-sm text-yellow-400">ADMIN</div>
                <div class="text-xs text-gray-400">Administra</div>
            </div>
        </div>

        <!-- PROYECTOS — sin x-data propio, usa el scope del padre -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Asignar a proyectos</span>
                <div class="flex-1 h-px bg-[#00C853]/15"></div>
            </div>
            <div class="flex flex-col gap-1.5">
                @foreach($projects as $project)
                <div @click="selectedProjects.includes({{ $project->id }})
                        ? selectedProjects = selectedProjects.filter(p => p !== {{ $project->id }})
                        : selectedProjects.push({{ $project->id }})" :class="selectedProjects.includes({{ $project->id }})
                        ? 'bg-[#00C853]/6 border-[#00C853]/25'
                        : 'bg-[#182236] border-[#00C853]/15'"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl border cursor-pointer transition-all">

                    <div :class="selectedProjects.includes({{ $project->id }}) ? 'bg-[#00C853]' : 'bg-[#8AAABB]'"
                        class="w-2 h-2 rounded-full shrink-0 transition-all"></div>

                    <span class="text-[13px] flex-1">{{ $project->name }}</span>

                    <div :class="selectedProjects.includes({{ $project->id }}) ? 'bg-[#00C853] border-[#00C853]' : 'border-[#8AAABB]/30'"
                        class="w-[18px] h-[18px] rounded-[5px] border flex items-center justify-center shrink-0 transition-all">
                        <svg x-show="selectedProjects.includes({{ $project->id }})" width="10" height="10" fill="none"
                            stroke="white" stroke-width="3" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="flex justify-between items-center p-6 border-t border-green-500/20 shrink-0">
        <div class="text-xs text-gray-400">
            ID: <b x-text="'#' + String(formData.id).padStart(3, '0')"></b>
        </div>
        <div class="flex gap-2">
            <button @click="$dispatch('close-edit-modal'); document.body.style.overflow='';"
                class="btn-ghost flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium text-[#8AAABB] bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all hover:bg-[#182236]/80">
                Cancelar
            </button>
            <button @click="save()"
                class="px-5 py-2 rounded-lg bg-green-400 text-black font-medium hover:bg-green-300 transition-all">
                Guardar
            </button>
        </div>
    </div>

    <!-- FORM OCULTO -->
    <form x-ref="editForm" :action="`/users/${formData.id}`" method="POST" style="display:none">
        @csrf
        @method('PUT')
        <input type="hidden" name="first_name" :value="formData.nombre">
        <input type="hidden" name="last_name" :value="formData.apellido">
        <input type="hidden" name="email" :value="formData.email">
        <input type="hidden" name="status" :value="formData.status">
        <input type="hidden" name="role" :value="formData.role">
        {{-- Los inputs de projects[] se inyectan dinámicamente en save() --}}
    </form>

    <script>
        function editUserForm() {
            return {
                formData: {
                    id: null,
                    nombre: '',
                    apellido: '',
                    email: '',
                    status: 1,
                    role: '',
                },

                // ✅ selectedProjects ahora vive en el scope raíz
                selectedProjects: [],

                loadUserData(data) {
                    this.formData.id       = data.userId;
                    this.formData.nombre   = data.nombre;
                    this.formData.apellido = data.apellido;
                    this.formData.email    = data.email;
                    this.formData.status   = data.status;
                    this.formData.role     = data.role;

                    // ✅ Cargar proyectos del usuario al abrir el modal
                    this.selectedProjects  = data.projects ?? [];
                },

                save() {
                    // ✅ Limpiar proyectos previos para no duplicar
                    this.$refs.editForm
                        .querySelectorAll('input[name="projects[]"]')
                        .forEach(el => el.remove());

                    // ✅ Inyectar un input hidden por cada proyecto seleccionado
                    this.selectedProjects.forEach(projectId => {
                        const input = document.createElement('input');
                        input.type  = 'hidden';
                        input.name  = 'projects[]';
                        input.value = projectId;
                        this.$refs.editForm.appendChild(input);
                    });

                    this.$refs.editForm.submit();
                }
            }
        }
    </script>

</div>