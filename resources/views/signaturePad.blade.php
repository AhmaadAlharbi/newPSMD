<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Signature Pad demo</title>
    <meta name="description" content="Signature Pad - HTML5 canvas based smooth signature drawing using variable width spline interpolation.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;800&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            height: 100vh;
            width: 100%;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            margin: 0;
            padding: 32px 16px;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAb1UlEQVR4nHXdy3Xj2BJE0TuGCXSDdtAN2kE3aAfcgB10g2+gOtBWNt5AS1USeD/5iYwIsqvX+/3ens/ndr/ft/v9vh3Hse37vt1ut23f9+31em33+3273W7b4/HYjuPY7vf79nq9trXWdrvdttfrdX7dbrftOI7t+Xxu7/d7O45jezwe2+fz2R6Px7bv+7nf6/XaHo/H9nq9tn3ft/f7vd3v9+3z+Wzf7/dc6/1+/zlLa38+n+04ju3z+Wz3+/187jiO89njOLa11vb9frfH47Hdbrft+/1un8/nPO/tdtuez+e27/v5zOv12j6fz/b5fLa11rbv+/nnz+ezPZ/P7fP5bO/3+z8xejwe2/P53NZa5/fu9P1+t+M4zvh2tu63SkgPtZkXaKPP53M+836/z8U7eJftciWhNdq4RBWIEl2iuuRa69y3Ink+n+d5S2pJN6Ez0T1fMgv6WusspvYtMcXi+Xyed9j3/bx365q0+Xx3KiHv9/v8ut1u555nguZDVkkbFuTb7XZeqtdVSWutc5MC2SHrhIJilVRRVbJdZ/ANYs8XgIqk4Bd0O6R9u2N/L6EVUK+tqAro4/E416s7SqLdUDF414qjovl+v2fhFYu6ZQUjQpYHr6pboCSVAKt13/ezkgusXVLAvZRd2QWsxqq/S5mQEl9Aqm6LQggySc/nc3u9Xtv3+z3PZUKs9tbp2aCneBTDCrPk1SE9I5J0fiH99Xr9dEiBrBI6kD8r4AWyaqyjSoDzqNd3qTC/IHYxX1/FFtyCV+IMpu1eURSIgl3BTPiqc+vSnmvP0KDAi/ndyfnVWq7fa01K56hL+vMZh4Jblm3vWTVt3ldBLtNVn8F6v99nVXWJhmqBrsJ7fWdybpS0gic2m5gSHZQ2JwyqUNi+xaDnSnKJqSvbv3Xba862irWzdV6humQZi1UAOmyJCdtsNTcr8LWybd3vCkhBs7qFkw5TMKykOkZmJnMpafMc3ctkVaUGVnyXjMzZcxzHnzUjKc5VmWDrzucqiO4uo308HttyILahENWB+ioQBrALGNDWqiK6UAeps6yWukBKWsWbyF5bxcmyhAThpUqcRRWstKczpnPWDXVkv694pbrd23VLaPct1pf370JN/DZusR6UiXUQ4aUKqcJKaHgqM7JrpMDhf4XgbKhICrh02TPHdrqog7Vua73OUteJ7RWA0CxpkKj0u/btzyKPFN15VgdVbKtLK8S6qGyipAVfUuECfvX3mM0cvl6qJPeznu/ndYnVLv+vALrDLBjXdn07WFp7BucfbbfzhZ9mp/FpXsmg2sP1ZH3F+H6//ySkVuxiVpEqsuzLz6v6Lmm1FYDw1A5osDskxVYrs0NXcSY/OBF2dQik5AVRyip0OEtmR9jJfjkbFc/OxpLdeYpFQ92CW11UmHK4CUcOOAd12S8YsTAZj5S2TinRvkaxNoWVMyKoLXjiducRGq/0hbaFVF5i4PC1Wwq4RKX9LFY7p4LsTsqIczYqCEvMhBKrr4VlIFWFynjaDSVAPq54qkJUzlPrqG7tPl2DIGNqjumB6Ux0lpIjCakQtDrsttadJMWzTWtGVBICP5/PthROYZz4W0Bn56gvPLywMqm0B+rZLqcN0uVV7xZOVTddBqHIWSLUFpjOeWXNOCPUGuqGuloUmBTWGaGa904K0Ofz+cOyelAlLe5qtmkN6KK2RhVeAoUNkxV02SleUqjpmS7t8xVRFab+mVUvztdJkz1aFHXDJAp1qnNC6JP2m2SFt6xPRraEqCpWuhvsqOidAZpsLV6SotG9Xt0ifBXYXiOEtr/BEuZMiN6UuKyqL1ESALWOToRU2g7rrCVtdts0JOfAVwLo7621fiBLauqQrgOELeeEl9a7kSF18QJdUDpUMyGodGAbUOdIAXIu9NXanaEBbgfKbhz0dq0zTHe2gOsiqPrtIuM5Z5Po45lWQe7iwZammW1vVjtEl1IJ6x9ZhXaGs8dOqq21M9IFfbVfwVK8/T8l3vo6AYo1v19pCTtJZjgLQXgs6NJzY1zBN/hXEORgUijOi0qDO4hdU4JU7jGOLmH1ddCeV4tYsSXYrmvPzq23JcSozDX75sxyyJaUU7BRYL6+RM/4aaxKUHrWc5jAVXXbAVbPbPEy3N+1JcTvKmpaEHaWyttDBX9qFZV/GkLu3zknVKjWhRih0IQbeB0DtVd76h4It+0TIkjrS4qWSvsdx/E3IQUrPBWLlf4FRCYiBE0qWyUHZ0Hk9IUm9Y4c6O46MLVj6mIv3h7OQhnWHOomt8KTWPi8SXVGKGztMJlhRSBROmGyIKgy28DLay+0uTaLbqwaxAsYQN8TcaB6eFW+1ozus6q8100WVwBKdM8pgH3GuSEJ0eZplvS9GHnOEmuBOEtN+Pm2dxcuUIqvAl97TidU1duM6OC2sFhdZVrlUt8Oro1jgOviOSSnVnEQ20UWkpClU2BRTCGoe9AdvF/3La7t6b0rdqH4hCxhQGo6/RnFVcmQ/eg/6dfYHXVByVUhe6nW03q4EqMmtmT3/GRpkgQFrJTcPQvclaHpm3D9XBNWZW+haiuJDNLkNU0/Z4Hm4vR/CmAD3BkjpsqyumTwp7nn4KwQdAiuFLRzQBPSewSZFZwdJUOad7XAjIf7q4GuCnh6ZxWHDkJrnZDV5ucPxvvPXdA37L2swZv2SRsbICvTpMo2pJayuyvRpmNgRcrgptEp5qtPVOpVfWfvfBWX8GrhtY4sMng0OUJid/l8Ptsq6FLaqq02MvsGukO2WFWkop/JsnquWIuB1cJQV+ghNa8UkMGFsGHROX8MePea76ELO7HFK/o/9VTQZfdOV9tu3ff9NyGKHAfuZEC2Z1jfYdzYznHg2lVd1sSLqbWy7Ky9pZV2lsxKpT7NReeCbyVMShq81o1CeneWDOhwSE66n3ZMBSupOs3FMF+RYguaiDSC8CX9FBocplosVlvBswOEu/bR0JOlVNV1SBBb1+tpdS5hRVbkXPgTKIiLRSgKeO/gb+oN46Br0ZnPhLh4wVVV2iUOuF4z+bo4q7jsmQIlY2qdimEGWPWvmu7yWjUluMQIj86T1i2h3c+3mKW7fYUQ7S1c9XvZndptCldft6SUZV7hdGXaaabZXYqxgqc1rZBUmYfH2iZ1jYO8YKppeq3Y7p1Krup82iiKQuHFedO9petBmrqm32sTqbEsDIuzYlxtYjYdqh2sQIiLtrpBN0AdTNNvDvESWTvPgelAnV7TtCim5SN11Reza+2ukiYcO5N6tkS5j5pHS8ozlTBn9R/hW2XqN9nOVoZ0V7GoptCL8mBzxliRUk55vhS15Kjs1Up2yvzgRl/CsEGw85wBE1JU5u3XgHdOSmzsJtexkILI4zh+3sKt0n2nT/tDHPx/lFCF3/NnG67fT4z3vKo/JqOeaE3fydPwk810UYuryvT3zaKetfvFd+HOu8r06twpBB38nUNV7vysMITQVcWIk3P6i7EeoEWsYiFLiLCznAlaLwa/v/shg87aRat6u+qsNIaswqvASMNLfEES3kxQ553zrDtaiNo6EqEKvvN6l+fz+ZOQHiw4siyzP2miargFrfqJv76BZfAdeLV+pKJuukp+3aQXZlUGKecnOnj7QIo9mZOCU19PLeYbUsXN+JWckEH06AzO5JMk2OotrqjSLEzFmwSxuMzLJFpT2mtCZUZBRp0pAyq4MRshojNYrTIY1b/ve/hmmtWuFaIqdzbVCcJmRdH80MoRNVrDOdyaS2yrQjqMlsW0PhQ3Zb/vqtA5zObsKAl6W8JmFVx16Q64lvCjkKzr7No6rfVcR9XdGlMYO6eExhKta24S6xZ1m1C91vr5KGlVICzZjnLlkqOd0aXsKiujNTxAF2lvK632l10VALFdJd48KQBXbK5ElBjXnkreypXWS3/dcxIhxaoEQCfAvUKXVeU4M1SOBUBI0i6p+rQ0ZsUXfB1bHVaHuupYBS9dLVEyGbtJM7COnszHJHV+dcjUWwXU10/2pLWk6PU8dmsx/6P4C9wUhVJIcbTqKyFu0t+nrR12T2uhPVW66gedgKBCgVnXtYddUNAmMwxSJSoSB4PaOSyuXifUdf/mZLDf69RfziVp9jln5PQGqIvLVKY5KGzIsFTxao6GpR/dkZL2bHtMlaugE0KmKq6ip4AU2uZ80ypSTFb5Ehs1ltAk/DvgjVvncSZr9yxnhGJl4qmfGmkBLRf9rysbWmfXtzGtsmaHM8bOmDrGgSvkdIdmlo6BbE4rRp/qqnqFFe/oDOguFpfOgsRDQd1z3+/3x8vqYRWjw0vGpMCTKsv/rbICX/uXBAfvDHzB8rNZwuB0D/THglLfQHPuqGGqbElMiVEHCaHOtJ6fat/nfJ1wL+ss/vu+/9BeRZcHkAZ6UCFOvt9a4bQtqbk24cU2d8jrCJtwz9fezagp9ubv2sMgSQbqjF4bLCsInW0VijOvGaKu0VKZg94z/PkoqfxdiuZFHfwKxF6n43ri4vr9DyOdN+Fo7VrQHX7TILS6Ta5uc/v0nA5Bz3jXOT/by+JTCF8J2CBM/0xB7HeJhLpn3/dfHaJl0Vdw1EJl2Xb3QNowXt5BVvd0aH2r9rOtLZA560674d8cmN6RnpJB9UN/Ogcqe/0z56nao+KQAgs/Mr7m6AlNfDix+O/7/tMh+jxVlMJFLHTQ9zotFA+nJSJj0xNypsw/O1Mm9jtQr7Beqly39foJGULHdAS6U3GRQsuU5gccnEu6xv1dGBXalhcWqmwzu6eqkwVpHfSc3lGQoe1iB1mpwqGqX6qoHTKZ05XtUfdZPKd3xDuNOq/SXAtIiOx7RaRtolA84Wit/xSieuf5/PeftE0+f6pG3hFT9MiwprXQRlOz9GftGZVxAdLv8m1XLRrXsdqaXVJo3QSh1E6r8qt+g29hSAL8u5rM85cUR8Ic7ML07Xb7nSFlsj9baVJH6aHeTr8TNrqUw9HusBKdF4q3zqCV4dwKqoQj59n82KlzxQ7RhzPoJb+fqZm6V8+WBAWxzLRzCF0lrb+vxJFQJKOq+q2CMuvBrBAhQejTPpCrF2z9KOeWtr5moYXjvjoCik/hTYYlxW+dXi90VSizAIXjzt/rJuO8YmGd6ziO338NyAOfqnH9/udjXcyF/fLDBylXPS8vKzTM+TVtDpW4Ca+iJRp+4lKhpi6SqFS5rj/9NdmZnRrtVpHLrHqtbkJnswmaSafbO9WpLSXzqFo6TPDQYs2PrGh1ga15ZTtUBF5IjJcJCp3BhZZElVlnqYbtuAkzqn8tkAKlHTIT0R7ete/dTwE5tYxzb51/WL//lZGzomqU8jXce+7M7r8uETe7YBCgJ1WV98zUGNLvLi9Tc3b8vyEaHAlvrSOzkwQ4N+ywgm7hSAx6nWva8cKsZq1uxDIYMqUu2KWmKi7bHWwyJ404fTHb9mQW4/33qcy7dEmYgsvfCRFXg1ibQ7p5BZkVqZCqmNP/q4Bda67fWWWidsnj8e8/+pTnGzR/11eZn8NQ2my3CU1aGdLJAtU6+lHCToFqPk0HQShtTqgVCu60bSZhqGK1jYqNhuKksvOtW2ekdlEFWmId+ssWLOC+DVoAJtY2dLukFaIQOlsRrl/nWQBB1wxWl1YTlYzgRGdAXWPRzM61ExziU9VLAISvnm+dYiiCiD76aVOM/zEmVbhWqmxDKml7mQxFky1a67excFHiHKiK0PbqfHpH/WwyNOl1BWax6dWpjVpvkhbP5J991t/PTnI+d686vDv5PszycuKefo5WyKxyW9FB24F1YkuKXamYqyCmqWggbX8TpDugiu+rAuh1zQKVthReQSyBmZ3r3rK+YMwO8q42gCJ0zUA2vLuEh/ODEHNAy0gcnn58VLgRSnwPuoBOvWLnVBQl2stdJcN9hCghKzguAQa8AjJ5siQDrAPRmhWD8ak7nKnHcfx+UM4f6slIhc10l+iwBaagdiirotfbHTKo6QJUza0pRNYpXlSImj+vEruTc8SuUCMomp2N7VOhVFDaT1o1xkzSoS46G6CHCqAV5xxJuff3AjsDHD42L0qKyvjK7iiZtb7sp8BWTVW9882ZYNfbNXV5HWqgheoSrhMr4xJiNFjtOAu8bjJhxVwmeBzHz+eypJElQwVtVruQrMP2bp4IDa3rs7NyDWKvCbq0UXRHC+CEg7rHAtNjuhrEk1nZsRbb1ZllS1LxSc0b8MWwEVBs9n3//feyDJY2RjhZden3eEgrTjtFCCtw08uZNLRDyrz0iApqzxRsK7OkTqU+/TGr+s9wHcrbDlQ4T9HoTCjBxdSPlfqupaRoKYr0ZibWlVGf0QKpNavgabR5WBMhRE0C0GVUuXlltntdoIelDihgEg4xvo7SKQgZ1F4Vp3d2Ztg1QlznlrgU78k2lx0RJjbIVZ4FtTbzIHpBbe77DD0jjZT+Gnjn07QVZuJ0mKdbYFJV1FoWU9/Y6ToQ2jEVmfRWyFI7GTv3lc1qjh4Hn35XDEr3xGId0EkTe43VfwVRBkJImn6ULd4l21sLpUSqiAuyTMyKFiKcJVJhZ6KJ6M8m0A5x9gWhxUMbqS6cxGf5kK0rzetCXbSLeFCVcNBghznwS67sSLUc/On6luhavE6VDTobrjpwqmgHawEUugz61GtCZbDksJY+hwzFUee4Lv9jLorB0yMqc9ohXtoETEUqnjp466SJq9Jv6XVnmFAgbZ1Ucs6Gfq5SPw299d9/fagvvTvhp+eKWYkombJItVj7VVTBew1xfnJxMoUuXGBbvGpQAU8HtMGr9uiyBbBDavhJaYMyXVPJR1Xbs64bFPTdj+iUYOm1GN/Z6za1xnQZTKo+nwm0iCzGziUBWGv9QNb0XdQOYrTDtdfYslMMdhg1xKSj87BCpu+l64v5d5PU2aWXV3pKC0f6KtZ7pmnj9LOZNOF27ueMlSBV1D1z/u8qZDZi5qzILqyVMumcVFfC4MDuZ356w/2seGfW/NxTA3VWZzBgt14VQJUvFXad7mOnFjPFpIk3Rp2jGRNUKTPUa+e/5KAeceAGadLIkiDbKvhqFTWJHzfq0OcgW78fzSx4Dl49JOGpJFUszjJxW91kx0pa/DBHz185C3W9glB2V/xKih6fFNv5pj93/ksOVYBYOytGT6nkNCRLrIJysiRJg7pEeixsOoyr6l4jA2pvL9jeFpLJ0cPS2ih4czBbdP3+9J9wedVC7SXKCGGd188VrCrUTQtmQbKtG9xVW61dAt3ACtHr0b6okhRYYm4/16JXHIrVYna4PyGwbu8MUubOqSapW6fnVQF7t6re+akmExYtzGD5OI7f99TVIgqVOHwV6nsK0karREVuC1ddQlYJn6Zha2ubSGGtUL0i6a8wYVf2GsmJFslMUPfve50uI5VUWFCtWVJKZjHXtXi9/v2PJdUEihXhQRyXaqpQ1RDTARBHrUQtkC7mxf2ZBaLBJ6sR81u3fTqfLsG+/34Iu25XvEkEJnuTKisoS76itZ/3TAkp9sVlVZFt4Ixw+jtUw9sOWZc1vDUdDeqcC5PNTaiYLEtTTrgrkFWfLNDu0uIQFbpTZ/Z13V+fqljFEkMG6bW6TfVeAdRRrXMyMbXElejre5cKeqqIgjyho8BbJVcMS+2ibujPBsxZ5hw42533caZn5J97NpWs86BzIXEoidLZglos/Jmf4AwRdAiKqcj0eDx+/4MdeXYX8qM3VphWhbqlwIupMjhtAw/qXOr1DVw/kmTnVVUKR3VD+yhG9bVU53a2r50Q6ufNlAoTqiYz6/nuWNzUI2fHVRVWigPHICuM5vvSHb6WDBclAwXOWTC7K7ppddopfoJSeqp+kR1Je4Uo7aAr306xWjyqcKWBndjPRJfW8fyhg3E5ddzk4LqsdUMXFrLCU4ez360cCYJzSiHZPNCicJ51wbrWS/QaHYCely1Kgzt/Q7lE2hme244tMa3jG2ZSdOm9jNKYFqcQaAU1KsYWbBB1kapAKLPCZ0WL224qc5GdTNVdYsJaSUYtrmOs3SJFdi2LSUuj4dxcdI5V8QXes1dQsqcgOPrbPOmM3s+3ir/f7+//T902llGopsVY4aiqElLERw07L6MlM5Os51RRVDDODgWl80+Bd8VoJuQWKCmwKNBrtEXqcN/38Rl1meRCsfgf+11888CTxtWyBlIFqh9Tcidrc6gXKA/vMJTWuk5JV+Q1w6ryCkEm1x5aFpqZJt6i88tZYgeIEN1LR0IyUeE0t5tv5ywPh+XrqscOYAWogn1zpwvPqpmV2rrtp/3R+l1KptTZHKbT5CzImnoFZs4BnWFp/fxsWZ0bhHVGP13izNAJcN65Znfu3J33/JCDGNjGBcjB2cayogIgU/F3+lpaCUJWAdEsnPS2itRRnlRb8apl4htmwpZr2d3tJZxOAS2R0UyVmlt0vr47K4Rfr9fv/4PK4Wswa80yr2p2mHrRAp+G6EBeJkbX4U1KzzhE+3mBjg22v8n2mc4r+SjIdv+cfVWvwfY+kpYKtTtYSCWi7yaqgviDLuJXVVSlOjDNqvohqJEeKrb0xvS7HM5TYKoD5uDt8ApCqWXB7TmHq79zhukOlKRJOjqHhaenFew1I2VxEiJpvPsVh1VganMtDB1SKyO4KSC1nIyhdZ0jVV3BdF7oEXn4AqiT0MVNhlqj4uq57jRFcIU0GY96qYBWRLrTFqOD3diIMt2tP89R8Xw+f/81II0wA1UGtRqkvIq6Ai8kiefzMAVDYiETEVa64NQ/+kP9TFZWwIQ4PbQCPgmCiSoOxkSdJjt0zrZ3nT1JhOyrdZbZl510QDHf74q6cNALWmF2jZBT5duyCr8SI6wU7II83z4oudLYYHAyLrtYUVhR6nU5L0uqH1JwaLuunTStEgVuBbhq36q+yxWwLlD3OLB7jS07Kaqisd9P3i7UVbkd0jP0/PxYj8LPmTGD1Zka+GoACYkmYr9XzXuHztvrZpeGHBWf1pJk5RTIXbBMeXi1QslQnc5Ocv7I668UuzZNh5bbq/rF2qlN5sCtirUlmj+t5WBXJ7XupOAyL8Vk9/OOQVlFJqmRmak9WvM4/v33ITIcLYcOKC9XwbdhVVPFhY+TLqoZpMqSBf0fBWgXl3JLRhRdwVn36jVXtlCF4YwoBsHo9OlKrtBlkYoodreiVY2isFxWeMEoy23mBwpauE7xwMGOA9KWNLAyqypNDVGAZERXdLX15oBUeHrW1vE54cpurCt8b2VaISawewufQmhrtl/r1dHf7/fXfg8DtTZ6UYf08gZQhdzPNB6tQCFDNqSAE/unkakVYVdWLCZ8GotdXqEr6yuYQrGzcFox2k12RcUgiREVphPS8/u+//67vZOadREv7PvHvs6Bq84Q7qTO7XVy7/X7b6RMJaw14UB1Hk0NVcdZ3eJ2AbIzTGrfpa8OZoeyRTjhVRng28VaNhVNhbcULg6nNncI93vfaFGMdfAu6gC2gmz9qkUR1kVP5rH+/r8Efabhb8fIWpwxQqLWjmq6eMz55lB3Fsy5IgTGIO1SZ7D0vXj/D1qZ7VFrqtW0AAAAAElFTkSuQmCC") repeat scroll center center #b3b3b3;
            font-family: 'Cairo', sans-serif;
        }

        .signature-pad {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            font-size: 10px;
            width: 100%;
            height: 100%;
            max-width: 700px;
            max-height: 460px;
            border: 1px solid #e8e8e8;
            background-color: #fff;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.08) inset;
            border-radius: 4px;
            padding: 16px;
        }

        .signature-pad::before,
        .signature-pad::after {
            position: absolute;
            z-index: -1;
            content: "";
            width: 40%;
            height: 10px;
            bottom: 10px;
            background: transparent;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.4);
        }

        .signature-pad::before {
            left: 20px;
            -webkit-transform: skew(-3deg) rotate(-3deg);
            transform: skew(-3deg) rotate(-3deg);
        }

        .signature-pad::after {
            right: 20px;
            -webkit-transform: skew(3deg) rotate(3deg);
            transform: skew(3deg) rotate(3deg);
        }

        .signature-pad--body {
            position: relative;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            border: 1px solid #f4f4f4;
        }

        .signature-pad--body canvas {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
        }

        .signature-pad--footer {
            color: #C3C3C3;
            text-align: center;
            font-size: 1.2em;
            margin-top: 8px;
        }

        .signature-pad--actions {
            display: -webkit-box;
            display: -ms-flexbox;
            /* display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between; */
            margin-top: 8px;
        }

        #github img {
            border: 0;
        }

        @media (max-width: 940px) {
            #github img {
                width: 90px;
                height: 90px;
            }
        }
    </style>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-39365077-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
</head>

<body onselectstart="return false">


    <div id="signature-pad" class="signature-pad">
        <div class="signature-pad--body">
            <canvas></canvas>
        </div>

        <div class="signature-pad--footer">

            <div class="signature-pad--actions">
                <div>
                    <button type="button" class="button hidden" data-action="change-color">Change color</button>
                    <button type="button" class="button hidden" data-action="change-width">Change width</button>
                    <button type="button" class="button hidden" data-action="undo">Undo</button>

                </div>
                <div>
                    <button type="button" class="button save hidden" data-action="save-png">Save as PNG</button>
                    <button type="button" class="button save hidden" data-action="save-jpg">Save as JPG</button>
                    <button type="button" class="button save hidden" data-action="save-svg">Save as SVG</button>
                </div>
            </div>

        </div>
        <button type="button" class="button clear bg-amber-500 w-full 	 text-white py-3 px-5 text-4xl hover:bg-amber-600 " data-action="clear">مسح</button>

        <button id="showSignBtn" class="bg-sky-900 text-white text-4xl mt-3  py-3 px-4 ">عرض التوقيع</button>
    </div>

    <form class="signature-pad-form hidden" class="text-center" method="POST" action="{{ route('signaturepad.upload') }}" enctype="multipart/form-data">
        @csrf
        <img id="sign" src="" alt="sign">
        <input name="signed" id="textImg" type="hidden" value="">
        <button class="submit-button bg-sky-900 text-white py-3 px-5 w-full text-2xl hover:bg-sky-700" type="submit">اعتماد التوقيع</button>

        <button id="backBtn" class="submit-button bg-amber-500 border-2 w-full mt-3 text-sky-900 py-3 px-5 text-2xl hover:bg-amber-200"> إعادة المحاولة</button>
    </form>
    <script>
        (function(global, factory) {
            typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
                typeof define === 'function' && define.amd ? define(factory) :
                (global = typeof globalThis !== 'undefined' ? globalThis : global || self, global.SignaturePad = factory());
        })(this, (function() {
            'use strict';

            class Point {
                constructor(x, y, pressure, time) {
                    if (isNaN(x) || isNaN(y)) {
                        throw new Error(`Point is invalid: (${x}, ${y})`);
                    }
                    this.x = +x;
                    this.y = +y;
                    this.pressure = pressure || 0;
                    this.time = time || Date.now();
                }
                distanceTo(start) {
                    return Math.sqrt(Math.pow(this.x - start.x, 2) + Math.pow(this.y - start.y, 2));
                }
                equals(other) {
                    return (this.x === other.x &&
                        this.y === other.y &&
                        this.pressure === other.pressure &&
                        this.time === other.time);
                }
                velocityFrom(start) {
                    return this.time !== start.time ?
                        this.distanceTo(start) / (this.time - start.time) :
                        0;
                }
            }

            class Bezier {
                constructor(startPoint, control2, control1, endPoint, startWidth, endWidth) {
                    this.startPoint = startPoint;
                    this.control2 = control2;
                    this.control1 = control1;
                    this.endPoint = endPoint;
                    this.startWidth = startWidth;
                    this.endWidth = endWidth;
                }
                static fromPoints(points, widths) {
                    const c2 = this.calculateControlPoints(points[0], points[1], points[2]).c2;
                    const c3 = this.calculateControlPoints(points[1], points[2], points[3]).c1;
                    return new Bezier(points[1], c2, c3, points[2], widths.start, widths.end);
                }
                static calculateControlPoints(s1, s2, s3) {
                    const dx1 = s1.x - s2.x;
                    const dy1 = s1.y - s2.y;
                    const dx2 = s2.x - s3.x;
                    const dy2 = s2.y - s3.y;
                    const m1 = {
                        x: (s1.x + s2.x) / 2.0,
                        y: (s1.y + s2.y) / 2.0
                    };
                    const m2 = {
                        x: (s2.x + s3.x) / 2.0,
                        y: (s2.y + s3.y) / 2.0
                    };
                    const l1 = Math.sqrt(dx1 * dx1 + dy1 * dy1);
                    const l2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);
                    const dxm = m1.x - m2.x;
                    const dym = m1.y - m2.y;
                    const k = l2 / (l1 + l2);
                    const cm = {
                        x: m2.x + dxm * k,
                        y: m2.y + dym * k
                    };
                    const tx = s2.x - cm.x;
                    const ty = s2.y - cm.y;
                    return {
                        c1: new Point(m1.x + tx, m1.y + ty),
                        c2: new Point(m2.x + tx, m2.y + ty),
                    };
                }
                length() {
                    const steps = 10;
                    let length = 0;
                    let px;
                    let py;
                    for (let i = 0; i <= steps; i += 1) {
                        const t = i / steps;
                        const cx = this.point(t, this.startPoint.x, this.control1.x, this.control2.x, this.endPoint.x);
                        const cy = this.point(t, this.startPoint.y, this.control1.y, this.control2.y, this.endPoint.y);
                        if (i > 0) {
                            const xdiff = cx - px;
                            const ydiff = cy - py;
                            length += Math.sqrt(xdiff * xdiff + ydiff * ydiff);
                        }
                        px = cx;
                        py = cy;
                    }
                    return length;
                }
                point(t, start, c1, c2, end) {
                    return (start * (1.0 - t) * (1.0 - t) * (1.0 - t)) +
                        (3.0 * c1 * (1.0 - t) * (1.0 - t) * t) +
                        (3.0 * c2 * (1.0 - t) * t * t) +
                        (end * t * t * t);
                }
            }

            class SignatureEventTarget {
                constructor() {
                    try {
                        this._et = new EventTarget();
                    } catch (error) {
                        this._et = document;
                    }
                }
                addEventListener(type, listener, options) {
                    this._et.addEventListener(type, listener, options);
                }
                dispatchEvent(event) {
                    return this._et.dispatchEvent(event);
                }
                removeEventListener(type, callback, options) {
                    this._et.removeEventListener(type, callback, options);
                }
            }

            function throttle(fn, wait = 250) {
                let previous = 0;
                let timeout = null;
                let result;
                let storedContext;
                let storedArgs;
                const later = () => {
                    previous = Date.now();
                    timeout = null;
                    result = fn.apply(storedContext, storedArgs);
                    if (!timeout) {
                        storedContext = null;
                        storedArgs = [];
                    }
                };
                return function wrapper(...args) {
                    const now = Date.now();
                    const remaining = wait - (now - previous);
                    storedContext = this;
                    storedArgs = args;
                    if (remaining <= 0 || remaining > wait) {
                        if (timeout) {
                            clearTimeout(timeout);
                            timeout = null;
                        }
                        previous = now;
                        result = fn.apply(storedContext, storedArgs);
                        if (!timeout) {
                            storedContext = null;
                            storedArgs = [];
                        }
                    } else if (!timeout) {
                        timeout = window.setTimeout(later, remaining);
                    }
                    return result;
                };
            }

            class SignaturePad extends SignatureEventTarget {
                constructor(canvas, options = {}) {
                    super();
                    this.canvas = canvas;
                    this._handleMouseDown = (event) => {
                        if (event.buttons === 1) {
                            this._drawningStroke = true;
                            this._strokeBegin(event);
                        }
                    };
                    this._handleMouseMove = (event) => {
                        if (this._drawningStroke) {
                            this._strokeMoveUpdate(event);
                        }
                    };
                    this._handleMouseUp = (event) => {
                        if (event.buttons === 1 && this._drawningStroke) {
                            this._drawningStroke = false;
                            this._strokeEnd(event);
                        }
                    };
                    this._handleTouchStart = (event) => {
                        if (event.cancelable) {
                            event.preventDefault();
                        }
                        if (event.targetTouches.length === 1) {
                            const touch = event.changedTouches[0];
                            this._strokeBegin(touch);
                        }
                    };
                    this._handleTouchMove = (event) => {
                        if (event.cancelable) {
                            event.preventDefault();
                        }
                        const touch = event.targetTouches[0];
                        this._strokeMoveUpdate(touch);
                    };
                    this._handleTouchEnd = (event) => {
                        const wasCanvasTouched = event.target === this.canvas;
                        if (wasCanvasTouched) {
                            if (event.cancelable) {
                                event.preventDefault();
                            }
                            const touch = event.changedTouches[0];
                            this._strokeEnd(touch);
                        }
                    };
                    this._handlePointerStart = (event) => {
                        this._drawningStroke = true;
                        event.preventDefault();
                        this._strokeBegin(event);
                    };
                    this._handlePointerMove = (event) => {
                        if (this._drawningStroke) {
                            event.preventDefault();
                            this._strokeMoveUpdate(event);
                        }
                    };
                    this._handlePointerEnd = (event) => {
                        if (this._drawningStroke) {
                            event.preventDefault();
                            this._drawningStroke = false;
                            this._strokeEnd(event);
                        }
                    };
                    this.velocityFilterWeight = options.velocityFilterWeight || 0.7;
                    this.minWidth = options.minWidth || 0.5;
                    this.maxWidth = options.maxWidth || 2.5;
                    this.throttle = ('throttle' in options ? options.throttle : 16);
                    this.minDistance = ('minDistance' in options ? options.minDistance : 5);
                    this.dotSize = options.dotSize || 0;
                    this.penColor = options.penColor || 'black';
                    this.backgroundColor = options.backgroundColor || 'rgba(0,0,0,0)';
                    this._strokeMoveUpdate = this.throttle ?
                        throttle(SignaturePad.prototype._strokeUpdate, this.throttle) :
                        SignaturePad.prototype._strokeUpdate;
                    this._ctx = canvas.getContext('2d');
                    this.clear();
                    this.on();
                }
                clear() {
                    const {
                        _ctx: ctx,
                        canvas
                    } = this;
                    ctx.fillStyle = this.backgroundColor;
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    this._data = [];
                    this._reset(this._getPointGroupOptions());
                    this._isEmpty = true;
                }
                fromDataURL(dataUrl, options = {}) {
                    return new Promise((resolve, reject) => {
                        const image = new Image();
                        const ratio = options.ratio || window.devicePixelRatio || 1;
                        const width = options.width || this.canvas.width / ratio;
                        const height = options.height || this.canvas.height / ratio;
                        const xOffset = options.xOffset || 0;
                        const yOffset = options.yOffset || 0;
                        this._reset(this._getPointGroupOptions());
                        image.onload = () => {
                            this._ctx.drawImage(image, xOffset, yOffset, width, height);
                            resolve();
                        };
                        image.onerror = (error) => {
                            reject(error);
                        };
                        image.crossOrigin = 'anonymous';
                        image.src = dataUrl;
                        this._isEmpty = false;
                    });
                }
                toDataURL(type = 'image/png', encoderOptions) {
                    switch (type) {
                        case 'image/svg+xml':
                            if (typeof encoderOptions !== 'object') {
                                encoderOptions = undefined;
                            }
                            return `data:image/svg+xml;base64,${btoa(this.toSVG(encoderOptions))}`;
                        default:
                            if (typeof encoderOptions !== 'number') {
                                encoderOptions = undefined;
                            }
                            return this.canvas.toDataURL(type, encoderOptions);
                    }
                }
                on() {
                    this.canvas.style.touchAction = 'none';
                    this.canvas.style.msTouchAction = 'none';
                    this.canvas.style.userSelect = 'none';
                    const isIOS = /Macintosh/.test(navigator.userAgent) && 'ontouchstart' in document;
                    if (window.PointerEvent && !isIOS) {
                        this._handlePointerEvents();
                    } else {
                        this._handleMouseEvents();
                        if ('ontouchstart' in window) {
                            this._handleTouchEvents();
                        }
                    }
                }
                off() {
                    this.canvas.style.touchAction = 'auto';
                    this.canvas.style.msTouchAction = 'auto';
                    this.canvas.style.userSelect = 'auto';
                    this.canvas.removeEventListener('pointerdown', this._handlePointerStart);
                    this.canvas.removeEventListener('pointermove', this._handlePointerMove);
                    this.canvas.ownerDocument.removeEventListener('pointerup', this._handlePointerEnd);
                    this.canvas.removeEventListener('mousedown', this._handleMouseDown);
                    this.canvas.removeEventListener('mousemove', this._handleMouseMove);
                    this.canvas.ownerDocument.removeEventListener('mouseup', this._handleMouseUp);
                    this.canvas.removeEventListener('touchstart', this._handleTouchStart);
                    this.canvas.removeEventListener('touchmove', this._handleTouchMove);
                    this.canvas.removeEventListener('touchend', this._handleTouchEnd);
                }
                isEmpty() {
                    return this._isEmpty;
                }
                fromData(pointGroups, {
                    clear = true
                } = {}) {
                    if (clear) {
                        this.clear();
                    }
                    this._fromData(pointGroups, this._drawCurve.bind(this), this._drawDot.bind(this));
                    this._data = this._data.concat(pointGroups);
                }
                toData() {
                    return this._data;
                }
                _getPointGroupOptions(group) {
                    return {
                        penColor: group && 'penColor' in group ? group.penColor : this.penColor,
                        dotSize: group && 'dotSize' in group ? group.dotSize : this.dotSize,
                        minWidth: group && 'minWidth' in group ? group.minWidth : this.minWidth,
                        maxWidth: group && 'maxWidth' in group ? group.maxWidth : this.maxWidth,
                        velocityFilterWeight: group && 'velocityFilterWeight' in group ?
                            group.velocityFilterWeight : this.velocityFilterWeight,
                    };
                }
                _strokeBegin(event) {
                    this.dispatchEvent(new CustomEvent('beginStroke', {
                        detail: event
                    }));
                    const pointGroupOptions = this._getPointGroupOptions();
                    const newPointGroup = Object.assign(Object.assign({}, pointGroupOptions), {
                        points: []
                    });
                    this._data.push(newPointGroup);
                    this._reset(pointGroupOptions);
                    this._strokeUpdate(event);
                }
                _strokeUpdate(event) {
                    if (this._data.length === 0) {
                        this._strokeBegin(event);
                        return;
                    }
                    this.dispatchEvent(new CustomEvent('beforeUpdateStroke', {
                        detail: event
                    }));
                    const x = event.clientX;
                    const y = event.clientY;
                    const pressure = event.pressure !== undefined ?
                        event.pressure :
                        event.force !== undefined ?
                        event.force :
                        0;
                    const point = this._createPoint(x, y, pressure);
                    const lastPointGroup = this._data[this._data.length - 1];
                    const lastPoints = lastPointGroup.points;
                    const lastPoint = lastPoints.length > 0 && lastPoints[lastPoints.length - 1];
                    const isLastPointTooClose = lastPoint ?
                        point.distanceTo(lastPoint) <= this.minDistance :
                        false;
                    const pointGroupOptions = this._getPointGroupOptions(lastPointGroup);
                    if (!lastPoint || !(lastPoint && isLastPointTooClose)) {
                        const curve = this._addPoint(point, pointGroupOptions);
                        if (!lastPoint) {
                            this._drawDot(point, pointGroupOptions);
                        } else if (curve) {
                            this._drawCurve(curve, pointGroupOptions);
                        }
                        lastPoints.push({
                            time: point.time,
                            x: point.x,
                            y: point.y,
                            pressure: point.pressure,
                        });
                    }
                    this.dispatchEvent(new CustomEvent('afterUpdateStroke', {
                        detail: event
                    }));
                }
                _strokeEnd(event) {
                    this._strokeUpdate(event);
                    this.dispatchEvent(new CustomEvent('endStroke', {
                        detail: event
                    }));
                }
                _handlePointerEvents() {
                    this._drawningStroke = false;
                    this.canvas.addEventListener('pointerdown', this._handlePointerStart);
                    this.canvas.addEventListener('pointermove', this._handlePointerMove);
                    this.canvas.ownerDocument.addEventListener('pointerup', this._handlePointerEnd);
                }
                _handleMouseEvents() {
                    this._drawningStroke = false;
                    this.canvas.addEventListener('mousedown', this._handleMouseDown);
                    this.canvas.addEventListener('mousemove', this._handleMouseMove);
                    this.canvas.ownerDocument.addEventListener('mouseup', this._handleMouseUp);
                }
                _handleTouchEvents() {
                    this.canvas.addEventListener('touchstart', this._handleTouchStart);
                    this.canvas.addEventListener('touchmove', this._handleTouchMove);
                    this.canvas.addEventListener('touchend', this._handleTouchEnd);
                }
                _reset(options) {
                    this._lastPoints = [];
                    this._lastVelocity = 0;
                    this._lastWidth = (options.minWidth + options.maxWidth) / 2;
                    this._ctx.fillStyle = options.penColor;
                }
                _createPoint(x, y, pressure) {
                    const rect = this.canvas.getBoundingClientRect();
                    return new Point(x - rect.left, y - rect.top, pressure, new Date().getTime());
                }
                _addPoint(point, options) {
                    const {
                        _lastPoints
                    } = this;
                    _lastPoints.push(point);
                    if (_lastPoints.length > 2) {
                        if (_lastPoints.length === 3) {
                            _lastPoints.unshift(_lastPoints[0]);
                        }
                        const widths = this._calculateCurveWidths(_lastPoints[1], _lastPoints[2], options);
                        const curve = Bezier.fromPoints(_lastPoints, widths);
                        _lastPoints.shift();
                        return curve;
                    }
                    return null;
                }
                _calculateCurveWidths(startPoint, endPoint, options) {
                    const velocity = options.velocityFilterWeight * endPoint.velocityFrom(startPoint) +
                        (1 - options.velocityFilterWeight) * this._lastVelocity;
                    const newWidth = this._strokeWidth(velocity, options);
                    const widths = {
                        end: newWidth,
                        start: this._lastWidth,
                    };
                    this._lastVelocity = velocity;
                    this._lastWidth = newWidth;
                    return widths;
                }
                _strokeWidth(velocity, options) {
                    return Math.max(options.maxWidth / (velocity + 1), options.minWidth);
                }
                _drawCurveSegment(x, y, width) {
                    const ctx = this._ctx;
                    ctx.moveTo(x, y);
                    ctx.arc(x, y, width, 0, 2 * Math.PI, false);
                    this._isEmpty = false;
                }
                _drawCurve(curve, options) {
                    const ctx = this._ctx;
                    const widthDelta = curve.endWidth - curve.startWidth;
                    const drawSteps = Math.ceil(curve.length()) * 2;
                    ctx.beginPath();
                    ctx.fillStyle = options.penColor;
                    for (let i = 0; i < drawSteps; i += 1) {
                        const t = i / drawSteps;
                        const tt = t * t;
                        const ttt = tt * t;
                        const u = 1 - t;
                        const uu = u * u;
                        const uuu = uu * u;
                        let x = uuu * curve.startPoint.x;
                        x += 3 * uu * t * curve.control1.x;
                        x += 3 * u * tt * curve.control2.x;
                        x += ttt * curve.endPoint.x;
                        let y = uuu * curve.startPoint.y;
                        y += 3 * uu * t * curve.control1.y;
                        y += 3 * u * tt * curve.control2.y;
                        y += ttt * curve.endPoint.y;
                        const width = Math.min(curve.startWidth + ttt * widthDelta, options.maxWidth);
                        this._drawCurveSegment(x, y, width);
                    }
                    ctx.closePath();
                    ctx.fill();
                }
                _drawDot(point, options) {
                    const ctx = this._ctx;
                    const width = options.dotSize > 0 ?
                        options.dotSize :
                        (options.minWidth + options.maxWidth) / 2;
                    ctx.beginPath();
                    this._drawCurveSegment(point.x, point.y, width);
                    ctx.closePath();
                    ctx.fillStyle = options.penColor;
                    ctx.fill();
                }
                _fromData(pointGroups, drawCurve, drawDot) {
                    for (const group of pointGroups) {
                        const {
                            points
                        } = group;
                        const pointGroupOptions = this._getPointGroupOptions(group);
                        if (points.length > 1) {
                            for (let j = 0; j < points.length; j += 1) {
                                const basicPoint = points[j];
                                const point = new Point(basicPoint.x, basicPoint.y, basicPoint.pressure, basicPoint.time);
                                if (j === 0) {
                                    this._reset(pointGroupOptions);
                                }
                                const curve = this._addPoint(point, pointGroupOptions);
                                if (curve) {
                                    drawCurve(curve, pointGroupOptions);
                                }
                            }
                        } else {
                            this._reset(pointGroupOptions);
                            drawDot(points[0], pointGroupOptions);
                        }
                    }
                }
                toSVG({
                    includeBackgroundColor = false
                } = {}) {
                    const pointGroups = this._data;
                    const ratio = Math.max(window.devicePixelRatio || 1, 1);
                    const minX = 0;
                    const minY = 0;
                    const maxX = this.canvas.width / ratio;
                    const maxY = this.canvas.height / ratio;
                    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                    svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                    svg.setAttribute('xmlns:xlink', 'http://www.w3.org/1999/xlink');
                    svg.setAttribute('viewBox', `${minX} ${minY} ${maxX} ${maxY}`);
                    svg.setAttribute('width', maxX.toString());
                    svg.setAttribute('height', maxY.toString());
                    if (includeBackgroundColor && this.backgroundColor) {
                        const rect = document.createElement('rect');
                        rect.setAttribute('width', '100%');
                        rect.setAttribute('height', '100%');
                        rect.setAttribute('fill', this.backgroundColor);
                        svg.appendChild(rect);
                    }
                    this._fromData(pointGroups, (curve, {
                        penColor
                    }) => {
                        const path = document.createElement('path');
                        if (!isNaN(curve.control1.x) &&
                            !isNaN(curve.control1.y) &&
                            !isNaN(curve.control2.x) &&
                            !isNaN(curve.control2.y)) {
                            const attr = `M ${curve.startPoint.x.toFixed(3)},${curve.startPoint.y.toFixed(3)} ` +
                                `C ${curve.control1.x.toFixed(3)},${curve.control1.y.toFixed(3)} ` +
                                `${curve.control2.x.toFixed(3)},${curve.control2.y.toFixed(3)} ` +
                                `${curve.endPoint.x.toFixed(3)},${curve.endPoint.y.toFixed(3)}`;
                            path.setAttribute('d', attr);
                            path.setAttribute('stroke-width', (curve.endWidth * 2.25).toFixed(3));
                            path.setAttribute('stroke', penColor);
                            path.setAttribute('fill', 'none');
                            path.setAttribute('stroke-linecap', 'round');
                            svg.appendChild(path);
                        }
                    }, (point, {
                        penColor,
                        dotSize,
                        minWidth,
                        maxWidth
                    }) => {
                        const circle = document.createElement('circle');
                        const size = dotSize > 0 ? dotSize : (minWidth + maxWidth) / 2;
                        circle.setAttribute('r', size.toString());
                        circle.setAttribute('cx', point.x.toString());
                        circle.setAttribute('cy', point.y.toString());
                        circle.setAttribute('fill', penColor);
                        svg.appendChild(circle);
                    });
                    return svg.outerHTML;
                }
            }

            return SignaturePad;

        }));

        const wrapper = document.getElementById("signature-pad");
        const clearButton = wrapper.querySelector("[data-action=clear]");
        const changeColorButton = wrapper.querySelector("[data-action=change-color]");
        const changeWidthButton = wrapper.querySelector("[data-action=change-width]");
        const undoButton = wrapper.querySelector("[data-action=undo]");
        const savePNGButton = wrapper.querySelector("[data-action=save-png]");
        const saveJPGButton = wrapper.querySelector("[data-action=save-jpg]");
        const saveSVGButton = wrapper.querySelector("[data-action=save-svg]");
        const canvas = wrapper.querySelector("canvas");
        const signaturePad = new SignaturePad(canvas, {
            // It's Necessary to use an opaque color when saving image as JPEG;
            // this option can be omitted if only saving as PNG or SVG
            backgroundColor: 'rgb(255, 255, 255)'
        });

        // Adjust canvas coordinate space taking into account pixel ratio,
        // to make it look crisp on mobile devices.
        // This also causes canvas to be cleared.
        function resizeCanvas() {
            // When zoomed out to less than 100%, for some very strange reason,
            // some browsers report devicePixelRatio as less than 1
            // and only part of the canvas is cleared then.
            const ratio = Math.max(window.devicePixelRatio || 1, 1);

            // This part causes the canvas to be cleared
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);

            // This library does not listen for canvas changes, so after the canvas is automatically
            // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
            // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
            // that the state of this library is consistent with visual state of the canvas, you
            // have to clear it manually.
            //signaturePad.clear();

            // If you want to keep the drawing on resize instead of clearing it you can reset the data.
            signaturePad.fromData(signaturePad.toData());
        }

        // On mobile devices it might make more sense to listen to orientation change,
        // rather than window resize events.
        window.onresize = resizeCanvas;
        resizeCanvas();

        function download(dataURL, filename) {
            const blob = dataURLToBlob(dataURL);
            const url = window.URL.createObjectURL(blob);

            const a = document.createElement("a");
            a.style = "display: none";
            a.href = url;
            a.download = filename;

            document.body.appendChild(a);
            a.click();

            window.URL.revokeObjectURL(url);
        }

        // One could simply use Canvas#toBlob method instead, but it's just to show
        // that it can be done using result of SignaturePad#toDataURL.
        function dataURLToBlob(dataURL) {
            // Code taken from https://github.com/ebidel/filer.js
            const parts = dataURL.split(';base64,');
            const contentType = parts[0].split(":")[1];
            const raw = window.atob(parts[1]);
            const rawLength = raw.length;
            const uInt8Array = new Uint8Array(rawLength);

            for (let i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
            }

            return new Blob([uInt8Array], {
                type: contentType
            });
        }

        clearButton.addEventListener("click", () => {
            signaturePad.clear();
        });

        undoButton.addEventListener("click", () => {
            const data = signaturePad.toData();

            if (data) {
                data.pop(); // remove the last dot or line
                signaturePad.fromData(data);
            }
        });

        changeColorButton.addEventListener("click", () => {
            const r = Math.round(Math.random() * 255);
            const g = Math.round(Math.random() * 255);
            const b = Math.round(Math.random() * 255);
            const color = "rgb(" + r + "," + g + "," + b + ")";

            signaturePad.penColor = color;
        });

        changeWidthButton.addEventListener("click", () => {
            const min = Math.round(Math.random() * 100) / 10;
            const max = Math.round(Math.random() * 100) / 10;

            signaturePad.minWidth = Math.min(min, max);
            signaturePad.maxWidth = Math.max(min, max);
        });

        savePNGButton.addEventListener("click", () => {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                const dataURL = signaturePad.toDataURL();
                download(dataURL, "signature.png");
            }
        });

        saveJPGButton.addEventListener("click", () => {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                const dataURL = signaturePad.toDataURL("image/jpeg");
                download(dataURL, "signature.jpg");
            }
        });

        saveSVGButton.addEventListener("click", () => {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                const dataURL = signaturePad.toDataURL('image/svg+xml');
                download(dataURL, "signature.svg");
            }
        });
    </script>

    <script>
        const signaturePadActions = document.querySelector('.signaturePadActions');
        const sign = document.querySelector('.signature-pad-form');
        const showSignBt = document.getElementById('showSignBtn')
        const imgTag = document.getElementById('sign')
        const textImg = document.getElementById('textImg')
        const backBtn = document.getElementById('backBtn')
        showSignBtn.addEventListener('click', e => {
            e.preventDefault();
            if (!signaturePad.isEmpty()) {
                const imageURL = canvas.toDataURL();
                imgTag.setAttribute('src', imageURL)
                imgTag.height = canvas.height;
                imgTag.width = canvas.width;
                imgTag.style.display = 'block';
                textImg.value = imageURL;
                sign.classList.remove('hidden')
                wrapper.classList.add('hidden')
            } else {
                Swal.fire(
                    'خطأ',
                    'يرجى تسجيل توقيعك',
                    'error'
                )
            }

        })
        backBtn.addEventListener('click', (e) => {
            e.preventDefault();
            sign.classList.add('hidden')
            wrapper.classList.remove('hidden')
            signaturePad.clear();

        })
    </script>
</body>

</html>