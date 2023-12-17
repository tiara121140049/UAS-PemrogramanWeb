
const keyword = document.getElementById('keyword')
const btnCari = document.getElementById('btnCari')
let container = document.getElementById('container')


// keyword.addEventListener('keyup',function (){
//     const req = new XMLHttpRequest();

//     req.onreadystatechange = function(){
//         if(req.readyState == 4 && req.status == 200){
//             container.innerHTML = req.responseText
//         }
//     }

//     req.open('GET','data.php?keyword=' + keyword.value,true)
//     req.send();
// })

keyword.addEventListener('keyup',async(e)=>{
    const response = await axios.get('data.php?keyword=' + keyword.value)
    console.log(response.data)
    container.innerHTML = response.data
})