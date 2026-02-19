<style type="text/css">

  .full { display: block; width: 100%; }

  .main {
    margin: auto;
    width: 100%;
    max-width: 1200px;
    font-family: "PT Sans", sans-serif;
    font-size: 14px;
    background-color: white;
  }

  .card {
    box-shadow: 0 0 20px 0 rgba(0,0,0,0.1);
    transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
  }

  .colx { width: 50%; }

  input, select, option {
    font-family: "PT Sans", sans-serif;
  }

  input.khyzer[type=text],
  input.khyzer[type=email],
  input.khyzer[type=password],
  select.khyzer,
  textarea {
    width: 100%;
    max-width: 100%;
    font-family: "PT Sans", sans-serif;
    font-size: 14px;
    height: auto;
    padding: 8px 12px;
    border: 1px solid var(--theme);
    color: black;
    background-color: white;
    border-radius: 6px;
    box-sizing: border-box;
    resize: vertical;
    text-align: left;
    position: relative;
    z-index: 1;
  }

  select.khyzer {
    border: 1px solid var(--theme);
    text-align: left;
    text-align-last: left;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    max-width: 100%;
  }

  .btn {
    font-family: "PT Sans", sans-serif;
    background-color: var(--theme);
    color: #fffafa;
    border: 1px solid var(--theme);
    border-radius: 25px;
    padding: 8px 4px;
    font-size: 14px;
    width: 100%;
    max-width: 220px;
    cursor: pointer;
    outline: none;
  }

  .btn:hover {
    outline: none;
    background-color: transparent;
    border: 1px solid var(--theme);
    color: var(--theme);
    transition: 0.2s;
    transform: scale(1.1);
  }

  ::placeholder {
    font-family: "PT Sans", sans-serif;
    font-size: 13px;
    color: rgba(0,0,0,0.9);
    opacity: 0.5;
  }

  .tooltip {
    background-color: #3c3a3a;
    color: #d0d0d0;
    border: 1px solid black;
    border-radius: 4px;
    font-size: 12px;
  }

  @media screen and (max-width: 600px) {
    .main { background-color: white; padding: 0; border-radius: 0; }
    .colx { width: 100%; }
    .sldr-div { margin: 0 auto 30px; min-width: 100px; }
    .card { box-shadow: none; }
    .responsive-table { overflow-x: auto; }

    input.khyzer[type=text],
    input.khyzer[type=email],
    input.khyzer[type=password],
    select.khyzer,
    textarea {
      font-size: 13px;
    }
  }

</style>

<style type="text/css">
  .ui-tooltip {
    background-color: black;
    color: white;
    font-size: 12px;
    border: 1px solid black;
    font-family: "PT Sans", sans-serif;
    border-radius: 4px;
  }

  .ui-tooltip a { color: white; text-decoration: underline; }

  .ui-widget-shadow {
    -webkit-box-shadow: 0 0 0 #666666;
    box-shadow: 0 0 0 #666666;
  }
</style>
