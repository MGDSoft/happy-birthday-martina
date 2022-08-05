
<style>
    .container {
        background-color: rgba(245, 245, 245, 0.57);
        text-align: center;
        padding: 20px;
        width: auto;
        margin: 30px;
        border-radius: 10px;
    }

    .cont-count{
        margin-top: 5vh
    }
    .countdown{
        font-size: 3em;
    }
    .gifts{
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 20px;
    }
    .footer{
        margin: 50px;
    }
    .gifts h3{
        background: white;
        margin: 0;
        padding: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border: 2px solid #000;
    }

    .gifts h2{
        background: #ff4c4c;
        padding: 10px;
        margin: 0;
        margin-top: -4px;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        border: 2px solid #000;
        cursor: pointer;
        text-align: center;
    }
    .gifts h2:hover, .gifts h2:active{
        background: #64d30b;
        color: #000;
    }
    .simpsons {
        position: fixed;
        bottom: 10px;
        width: 400px;
    }
    @media (max-width: 500px){
        .container {
            margin: 10px 0;
            padding: 10px 0;
            font-size: 0.8em;
        }
        .countdown span{
            display: block;
        }
        .gifts{
            grid-template-columns: 1fr;
        }
    }
</style>
<script>
    import Countdown from 'svelte-countdown/src/index.js'

    let gifts = [
      {title: 'Safary 🐻', videoUrl: '_lOqKIYW3Tg'},
      {title: 'Faunia 🦭', videoUrl: 'XCF83Fv99Ok'},
      {title: 'Warner 🎢', videoUrl: 'V3fbiZWYhfc'},
      {title: 'Warner Beach 🌊', videoUrl: 'T6x44-Y2nN8'},
    ];
    // Required there a bug in svelte-countdown library, by default remaining.done is true...
    let visible = false;
    setInterval(() => {
      visible = true
    }, 1200)

    let giftSelected;
    (async () => {
      if (giftSelected = await fetch('/result.txt').then(res => res.text())) {
        giftSelected = gifts.find((gift) => gift.title==giftSelected);
      }
    })()

    let selectGift = (gift) => {
      giftSelected = gift
      fetch('/select.php?gift=' + gift.title)
    }
</script>

<Countdown from="2022-08-06 17:00:00" dateFormat="YYYY-MM-DD H:m:s" zone="Europe/Madrid" let:remaining >
    {#if visible}
        {#if remaining.done === false }
            <div class="container cont-count animate__animated animate__backInLeft">
                <h2>Ya queda menos para el gran día 🦄</h2>
                <div class="countdown">
                    {#if remaining.days}<span>{remaining.days} días</span>{/if}
                    <span>{remaining.hours} horas</span>
                    <span>{remaining.minutes} minutos</span>
                    <span>{remaining.seconds} segundos</span>
                </div>
            </div>
            <img class="simpsons" src="/img/simpsons.png">
        {:else}
            {#if !giftSelected}
                <div class="container animate__animated animate__backInLeft">
                    <h1 class="animate__animated animate__fadeInDown">🎂 Felicidades Martina 🎂</h1>

                    <h2>Elige uno de los siguientes regalos</h2>
                </div>
                <div class="gifts">
                    {#each gifts as gift}
                        <div class="gift">
                            <h3>{gift.title}</h3>
                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/{gift.videoUrl}" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <h2 on:click={() => selectGift(gift)}>Seleccionar 👍</h2>
                        </div>
                    {/each}
                </div>
            {:else}
                <div class="container animate__animated animate__backInLeft">
                    <h1>Has elegido {giftSelected.title} </h1>
                    <iframe width="100%" height="415" src="https://www.youtube.com/embed/{giftSelected.videoUrl}" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <h1>Buaahh!! este año pinta que lo vamos a pasar mejor que el año pasado 😎!</h1>
                    <img src="/img/patri.jpeg">
                </div>
            {/if}
            <div class="footer"></div>
        {/if}
    {/if}
</Countdown>