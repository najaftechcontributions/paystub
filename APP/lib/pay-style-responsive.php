<style>
  /* =====================================================
   RESPONSIVE
===================================================== */
@media (max-width:860px){
  .es-row.es-4,
  .es-row.es-payrow{
    grid-template-columns:1fr 1fr;
  }
  .es-middle{
    grid-template-columns:1fr!important;
  }
  .es-title{
    width:240px;
    font-size:13px;
  }
}


/* =====================================================
   MOBILE FOOTER – INLINE ROW PER ITEM
===================================================== */
@media (max-width: 640px){

  /* One column footer */
  .es-bottom{
    grid-template-columns: 1fr;
  }

  /* Each row is a single horizontal line */
  .es-gross,
  .es-totalded,
  .es-net{
    grid-column: 1 / -1;
    display: grid;
    grid-template-columns: auto 1fr;
    align-items: center;
    gap: 8px;
    border-right: 0;
  }

  /* Label stays inline */
  .es-gross .es-h2,
  .es-totalded .es-h2,
  .es-net .es-h2{
    grid-column: 1 / 2;
    white-space: nowrap;
  }

  /* Inputs stay to the right of label */
  .es-gross .es-inline,
  .es-totalded .es-inline,
  .es-net .es-inline{
    grid-column: 2 / 3;
    justify-content: flex-end;
  }

  /* Inputs flex properly */
  .es-in-md{
    max-width: 100%;
    width: 82px;
    /*width: auto;*/
  }

  .es-gross .es-h2, .es-totalded .es-h2, .es-net .es-h2 {
    font-size: 10px;
}

.h2-label{
    background-color: transparent;
    border: 0;
    text-align: center;
}

[label="responsive"]{display: revert;}



}

</style>