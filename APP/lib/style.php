<style type="text/css">
  
  .full{display: block;width: 100%;}

  .main{
    margin: auto;
    width:100%;
    max-width: 1200px;
    font-family: var(--default-font);
    font-weight: 300;
    font-size: 14px;
    background-color: white;

/*    border:1px solid red;*/
}

  .card{
    box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
    transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
}

.colx{width: 50%;}

input,select,option{
    font-family: var(--default-font);
    font-weight: 300;
}

input.khyzer[type=text], input.khyzer[type=email], input.khyzer[type=password], select.khyzer, textarea {
    width: 100%;
    max-width: 100%;
    /* min-width: 100px; */
    /* max-width: 135px; */
    font-family: var(--default-font);
    font-size: 12px;
    /* font-weight: bold; */
    height: auto;
    padding: 8px;
    border: 1px solid var(--theme);
    /* border-bottom: 1.5px solid #8e959f; */
    color: black;
    background-color: white;
     border-radius: 6px; 
    box-sizing: border-box;
    resize: vertical;
    text-align: left;
    /* margin-top: 12px; */
    padding-left: 12px;
    font-weight: 300;
    font-size: 16px;
    position: relative;
    z-index: 1;
}

select.khyzer {
    /* color: black; */
    /* background: transparent; */
     border: 1px solid var(--theme); 
    /* border-bottom: 1px solid white; */
    text-align: left;
    text-align-last: left;
     border-radius: 6px; 
    /* margin-top: 12px; */
    /* max-width: 250px; */
    font-size: 14px;
    cursor: pointer;
/*    width: 169px;*/
    max-width: 100%;
    /* font-weight: 300; */
}

.btn {
    font-family: var(--default-font);
    background-color: var(--theme);
    color: #fffafa;
    border: 1px solid var(--theme);
    border-radius: 25px;
    padding: 4px;
    font-size: 16px;
    width: 100%;
    max-width: 220px;
    /* height: 50px; */
    cursor: pointer;
    outline: none;
}

.btn:hover {

  outline: none;
  background-color: transparent;
  border:1px solid var(--theme);
  color: var(--theme);
  transition: 0.2s;
  transform: scale(1.1);
}



::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    font-family: var(--default-font);
        font-size: 12px;
  color: rgb(0, 0 ,0 , 0.9);
  opacity: 0.5; /* Firefox */
}



  .tooltip{
    background-color: #3c3a3a;
    color: #d0d0d0;
    border: 1px solid black;
    border-radius: 4px;
    font-size: 12px;
}




@media screen and (max-width: 600px) {

    .main{background-color: white;padding:0px;border-radius:0px;}

.colx{width: 100%;}

.sldr-div {
    margin-bottom: 30px;
    min-width: 100px;
    margin-left: auto;
    margin-right: auto;
}


.card{
    box-shadow: 0px 0px 20px 0px rgba(0,0,0,0);
}


.responsive-table{
  overflow-x: auto;
}

}

</style>

<style type="text/css">
  .ui-tooltip{
    background-color:black;
    color: white;
    font-size: 12px;
    border: 1px solid black;
    font-family: var(--default-font);
    border-radius: 4px;
  }

  .ui-tooltip a{color: white;text-decoration: underline;}

  .ui-widget.ui-widget-content {
    /*border: 1px solid var(--theme);*/
}

.ui-widget-shadow {
     -webkit-box-shadow: 0px 0px 0px #666666; 
     box-shadow: 0px 0px 0px #666666; 
}
</style>

