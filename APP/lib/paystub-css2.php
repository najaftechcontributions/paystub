<style type="text/css">
    .pd-x{
        padding: 20px;
        /*min-height: 300px;*/
    }

    .input-div{
      margin-bottom: 18px;
   }

   .input-div > div:nth-child(1) {
    font-weight: 700;
    margin: 10px 0;
}


.checkbox{
cursor: pointer;
}

.checkbox:before{
    content: "\f0c8 \00a0";
    font-family: "Font Awesome 5 Pro";
    font-weight: 400;
    color: var(--theme);
    cursor: pointer;
}

.checkbox.checked:before{
    content: "\f14a \00a0";
    font-family: "Font Awesome 5 Pro";
    font-weight: 900;
}

[sdi-label="1"]{
    cursor: pointer;
}
</style>



<style>
  .paystub-dwn {
    margin: auto;
    max-width: 80%;
    font-size: 18px;
    font-weight: 500;
    color: #6f6f6f;
}

</style>

<style>
  .es-wrap-w{
  position: relative;
  background:#fff;
}

.wtmrk::before {
    content: "";
    position: absolute;
    inset: 0;
    background: url("lib/watermark.png") bottom center no-repeat;
    background-size: 88%;
    opacity: 0.07;
    pointer-events: none;
    z-index: 111;
}

/* Ensure content is above watermark */
.es-card,
.es-actions{
  position:relative;
  z-index:1;
}


.paystub-no-label{
    text-align: center;
}

/*[addon-paystubs-box="1"] [addon_paystub]{display: none;}*/
</style>


<style>

[paystub-input]{
    display: none;
}

[addon-rows="income"]{display: none;}

</style>


<style>
 /* 3 per row */
.flex-addon-subs {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}
.flex-addon-subs > div {
  flex: 0 0 calc((100% - 40px) / 3);
}

/* Card */
.ps-box {
  border: 2px solid var(--blue);
  background: #fff;
}
.paystub-title {
  background: var(--blue);
  color: #fff;
  padding: 10px 12px;
  font-size: 15px;
  font-weight: 600;
}
.ps-body {
  padding: 12px;
}

/* Floating label container */
.aps-inp {
  position: relative;
  margin-bottom: 14px;
}

/* Border label */
.f-label {
  position: absolute;
  top: -7px;
  left: 10px;
  background: #fff;
  padding: 0 6px;
  font-size: 11px;
  color: #777;
  letter-spacing: 0.4px;
}

/* Inputs */
.ps-input {
  width: 100%;
  padding: 10px 8px 8px;
  border: 1px solid #d6d6d6;
  font-size: 14px;
  box-sizing: border-box;
}
.ps-input:focus {
  outline: none;
  border-color: #0b84b4;
}

/* Pay period row */
.period-row {
  display: flex;
  align-items: center;
  gap: 6px;
}
.ps-input.small {
  flex: 1;
}
.dash {
  font-weight: 600;
  color: #555;
}


</style>