//variables
let selectCat = document.getElementById("categoriaSelect");
let subcatSelect = document.getElementById("subcategoriaSelect");
let formData = new FormData();
let options = {
  method: 'POST',
  body: formData
}

//Fetch categoria
fetch("getCatGets.php")
  .then((response) => response.json())
  .then((data) => {
    data.forEach((categoria) => {
      let opcion = document.createElement("option");
      opcion.value = categoria.id;  //tiene que ser los mismos nombres que BD.
      opcion.text = categoria.name; //tiene que ser los mismos nombres que BD.
      selectCat.appendChild(opcion);
    });
  })
  .catch((error) => {
    console.error("Error", error);
  });

  selectCat.addEventListener("change", function() {
    let valor = this.value;
    console.log("Valor seleccionado:", valor);

    formData.append("cat", valor);   //"cat", es el nombre que hemos puesto al declarar la variable con el POST
    subcatSelect.innerHTML = '';

    fetch("getSubGets.php", options)
    .then((response) => response.json())
    .then((data) => {
      data.forEach((subcategoria) => {
        let opcion = document.createElement("option");
        opcion.value = subcategoria.subID;
        opcion.text = subcategoria.name;
        subcatSelect.appendChild(opcion);
      });
    })
    .catch((error) => {
      console.error("Error", error);
    });
  });

  
