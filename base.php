<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
$base = "login";

$con = mysqli_connect($servidor, $usuario, $clave, $base);

if (!$con) {
    die("Error en la conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["guardar"])) {

    // Recibir datos del formulario
    $playerId = $_POST["playerId"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // INSERTAR TAMBIÉN EL PLAYERID
    $sql = "INSERT INTO registro (playerId, email, password) 
            VALUES ('$playerId', '$email', '$password')";

 try {
    if ($con->query($sql) === TRUE) {
        header("Location: ultimo.html");
        exit();
    }

} catch (mysqli_sql_exception $e) {

    // Error por ID duplicado
    if ($e->getCode() == 1062) {
        $mensaje= "<p style='color:red; font-size:20px; text-align:center;'>
               El ID ya está registrado
              </p>";
    } else {
        echo "<p style='color:red;'>
                Error al registrar: " . $e->getMessage() . "
              </p>";
    }
}}
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["playerId"]) && isset($_POST["password"])) {
    
    // Recibir datos del formulario de login y ESCAPARLOS
    $playerId = mysqli_real_escape_string($con, $_POST["playerId"]);
    $password_form = mysqli_real_escape_string($con, $_POST["password"]); 

    // Buscar el usuario
    $sql_login = "SELECT password FROM registro WHERE playerId = '$playerId'";
    
    $result = $con->query($sql_login);

    if ($result && $result->num_rows === 1) {
        // Usuario encontrado, verificar la contraseña.
        $row = $result->fetch_assoc();
        $password_db = $row['password'];
        
        // Requiere que la contraseña coincida directamente
        if ($password_form === $password_db) { 
            // Credenciales válidas
            header("Location: ultimo.html?login_id=" . $playerId);
            exit();

        } else {
            // Contraseña incorrecta
            header("Location: iniciar.html?error=1"); 
            exit();
        }

    } else {
        // Player ID no encontrado
        header("Location: iniciar.html?error=1"); 
        exit();
    }
}
$con->close();


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Simple</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>

<body class="p-4 md:p-8 flex justify-center items-center min-h-screen bg-gray-100"  style="
        background-image: url('img/fondologin.png');
        background-size: cover;
        
       
    ">

<div id="app" class="w-full max-w-md bg-black p-6 md:p-8 rounded-xl shadow-xl">
    <h1 class="text-3xl font-bold text-white mb-6 text-center">Iniciar sesión</h1>


    <form method="POST" action="" @submit="allowSubmit" class="space-y-5">
        <input type="hidden" name="guardar" value="1">

        <div>
            <label class="text-sm font-medium text-white mb-1 block">ID de jugador</label>
            <input 
                type="text"
                name="playerId"
                v-model="form.playerId"
                @blur="validateField('playerId')"
                :class="[baseInput, errors.playerId ? errorInput : '', (!errors.playerId && form.playerId) ? successInput : '']"
                placeholder="Ejemplo: 1234"
            >
            <span v-if="errors.playerId" class="text-red-500 text-sm mt-1 block">{{ errors.playerId }}</span>
        </div>

      
        <div>
            <label class="text-sm font-medium text-white mb-1 block">Correo electrónico</label>
            <input 
                type="email"
                name="email"
                v-model="form.email"
                @blur="validateField('email')"
                :class="[baseInput, errors.email ? errorInput : '', (!errors.email && form.email) ? successInput : '']"
                placeholder="ejemplo@correo.com"
            >
            <span v-if="errors.email" class="text-red-500 text-sm mt-1 block">{{ errors.email }}</span>
        </div>

       
        <div>
            <label class="text-sm font-medium text-white mb-1 block">Contraseña</label>
            <input 
                type="password"
                name="password"
                v-model="form.password"
                @blur="validateField('password')"
                :class="[baseInput, errors.password ? errorInput : '', (!errors.password && form.password) ? successInput : '']"
                placeholder="Mínimo 8 caracteres"
            >
            <span v-if="errors.password" class="text-red-500 text-sm mt-1 block">{{ errors.password }}</span>
        </div>

      
        <button 
            type="submit" 
            class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition"
        >
            Entrar
        </button>
 <a href="iniciar.html" 
            class="block text-center text-white hover:text-blue-800 font-medium mt-2">
            ¿Ya tienes cuenta? Inicia sesión
        </a>
        
        <a href="ultimo.html" class="block text-center text-blue-600 hover:text-blue-800 font-medium mt-2">
            Continuar sin iniciar sesión
        </a>
    </form>

    <div class="flex justify-center">
    <?php
    if(isset($mensaje)){
        echo $mensaje;
    }
    ?>
</div>

<script>
const { createApp, ref, computed } = Vue;

createApp({
    setup() {

        // IDs válidos
        const validPlayerIds = ["1001", "2002", "3003", "9999", "1000"];

        const form = ref({
            playerId: "",
            email: "",
            password: ""
        });

        const errors = ref({
            playerId: "",
            email: "",
            password: ""
        });

        const baseInput = "w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500";
        const errorInput = "border-red-500 ring-1 ring-red-500";
        const successInput = "border-green-500";

        function validateField(field) {
            errors.value[field] = "";

            if (field === "playerId") {
                if (!form.value.playerId) {
                    errors.value.playerId = "El ID es obligatorio.";
                } 
                else if (!/^[0-9]+$/.test(form.value.playerId)) {
                    errors.value.playerId = "El ID solo contiene números.";
                }
                else if (!validPlayerIds.includes(form.value.playerId)) {
                    errors.value.playerId = "El ID no existe.";
                }
            }

            if (field === "email") {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!form.value.email) errors.value.email = "El correo es obligatorio.";
                else if (!emailRegex.test(form.value.email)) errors.value.email = "Correo no válido.";
            }

            if (field === "password") {
                if (!form.value.password) errors.value.password = "La contraseña es obligatoria.";
                else if (form.value.password.length < 8) errors.value.password = "Debe tener al menos 8 caracteres.";
            }
        }

        const isFormValid = computed(() =>
            form.value.playerId &&
            form.value.email &&
            form.value.password &&
            !errors.value.playerId &&
            !errors.value.email &&
            !errors.value.password
        );

        function allowSubmit(event) {
            validateField("playerId");
            validateField("email");
            validateField("password");

            if (!isFormValid.value) {
                event.preventDefault();
                return;
            }

            // Guardar el ID en el navegador
            localStorage.setItem("playerId", form.value.playerId);
        }

        return {
            form,
            errors,
            baseInput,
            errorInput,
            successInput,
            validateField,
            isFormValid,
            allowSubmit
        };
    }
}).mount("#app");
</script>

</body>
</html>