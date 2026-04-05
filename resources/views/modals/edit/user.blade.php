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

        <!-- ESTADO -->
        <div class="text-[10px] uppercase tracking-widest text-gray-400 mb-3 flex items-center gap-2">
            Estado de la cuenta <div class="flex-1 h-px bg-green-500/20"></div>
        </div>

        <div class="flex gap-2 mb-6">
            <div @click="formData.status = 1"
                :class="formData.status == 1 ? 'border-green-500/30 bg-green-500/10 text-green-400' : 'border-green-500/20 bg-[#182236] text-gray-400'"
                class="flex-1 text-center p-2 rounded-lg border cursor-pointer">
                ● Activo
            </div>
            <div @click="formData.status = 0"
                :class="formData.status == 0 ? 'border-red-500/30 bg-red-500/10 text-red-400' : 'border-green-500/20 bg-[#182236] text-gray-400'"
                class="flex-1 text-center p-2 rounded-lg border cursor-pointer">
                ○ Inactivo
            </div>
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
                    role: ''
                },

                loadUserData(data) {
                    this.formData.id       = data.userId;
                    this.formData.nombre   = data.nombre;
                    this.formData.apellido = data.apellido;
                    this.formData.email    = data.email;
                    this.formData.status   = data.status;
                    this.formData.role     = data.role;
                },

                save() {
                    this.$refs.editForm.submit();
                }
            }
        }
    </script>

</div>