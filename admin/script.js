// cross icon of success and failed dialog box
if(document.getElementById("crossContact")){
  document.getElementById("crossContact").addEventListener('click',()=>{  
     document.getElementById("onSubmit").style.display="none";
   });
  }
  //edits notes
  let edits = document.getElementsByClassName('edit');
  if(document.getElementsByClassName('edit')){
        Array.from(edits).forEach((element) => {
            element.addEventListener('click', (e) => {
                document.getElementById('blur').style.display = "flex";
                tr = e.target.parentNode.parentNode;
                category = tr.getElementsByTagName('div')[0].innerText;
                heading = tr.getElementsByTagName('div')[1].innerText;
                subheading = tr.getElementsByTagName('div')[2].innerText;
                content = tr.getElementsByTagName('div')[4].innerText;
                edcategory.value = category;
                edheading.value = heading;
                edsubheading.value = subheading;
                edcontent.value = content;
                edsno.value = e.target.id.substr(1, );

            })
        })
      }
      //delete notes
       let deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener('click', (e) => {
                sno = e.target.id.substr(1, );
                if (confirm("Are you sure you want to delete this notes")) {
                    window.location = `index.php?delete=${sno}`;
                } 
            })
        })
        //delete notes comments
        let deletesc = document.getElementsByClassName('deletec');
        Array.from(deletesc).forEach((element) => {
            element.addEventListener('click', (e) => {
                sno = e.target.id.substr(1, );
                if (confirm("Are you sure you want to delete this comments")) {
                    window.location = `index.php?deletec=${sno}`;
                } 
            })
        })
        // Notes Edit cross icon
        let cross=document.querySelector("#cross");
        if(cross){
        cross.addEventListener('click', () => {
            document.querySelector("#blur").style.display = "none";
        });
      }
      // Pagination control
      let prev=document.getElementById('prev');
      let next=document.getElementById('next');
      let no_pages=next.previousElementSibling.id.substring(1,);
      
       let btn_count=document.getElementsByClassName("page")[0].id.substring(4,);
       console.log(btn_count)
       document.getElementById('p'+btn_count).classList.add("active");
      //pagination number button
      for(let i=1; i<=no_pages; i++){
          document.getElementById('p'+i).addEventListener('click',()=>{
          window.location=`index.php?page=${i}`;
      });
  }
  //pagination previous button
      prev.addEventListener('click',()=>{
          btn_count--;
          if(btn_count<=1){
              btn_count=1;
          }
          window.location=`index.php?page=${btn_count}`;
      })
      //pagination next button
      next.addEventListener('click',()=>{
          btn_count++;
          if(btn_count>=no_pages){
              btn_count=no_pages;
          }  
        window.location=`index.php?page=${btn_count}`;  
      })
      