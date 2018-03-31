# twitch_twitter-embed.php

### Twitter Embeds For Twitch Media

## Usage

Upload somewhere to run the PHP script. Use the [Twitter card validator](https://cards-dev.twitter.com/validator) to get it approved for usage.

### Channels (live and offline) - `channel`

*twitch_twitter-embed.php?channel=bobross*

#### Live

Uses most recent stream thumbnail, stream title, stream game, and channel embed player.

```html
<meta property="twitter:title" content="BobRoss playing Creative on Twitch!">
<meta property="twitter:description" content="Bob Ross Marathon">
<meta name="twitter:card" content="player">
<meta name="twitter:site" content="@twitch">
<meta name="twitter:image" content="https://static-cdn.jtvnw.net/previews-ttv/live_user_bobross-640x360.jpg">
<meta name="twitter:player" content="http://player.twitch.tv/?channel=bobross">
<meta name="twitter:player:width" content="640">
<meta name="twitter:player:height" content="360">
<meta name="twitter:image:partner_badge:src" content="https://clips-media-assets.twitch.tv/img/twitch-white-rgb.png"/>
```

#### Offline

*twitch_twitter-embed.php?channel=alca*

Uses offline stream image if available, simple visit message, and link to channel. (Stream link needs testing)

```html
<meta property="twitter:title" content="Alca on Twitch!">
<meta property="twitter:description" content="Visit Alca on Twitch!">
<meta name="twitter:card" content="player">
<meta name="twitter:site" content="@twitch">
<meta name="twitter:image" content="https://static-cdn.jtvnw.net/jtv_user_pictures/alca-channel_offline_image-24228ff2cb8bd6e5-640x360.png">
<meta name="twitter:player" content="https://twitch.tv/alca">
<meta name="twitter:player:width" content="640">
<meta name="twitter:player:height" content="360">
<meta name="twitter:image:partner_badge:src" content="https://clips-media-assets.twitch.tv/img/twitch-white-rgb.png"/>
```

### Videos - `video`

*twitch_twitter-embed.php?video=241633142*

Uses video title, video thumbnail, and video embed player.

```html
<meta property="twitter:title" content="Video by TehSmileys on Twitch!">
<meta property="twitter:description" content="Solid Gold Hand Cannon | FORTNITE">
<meta name="twitter:card" content="player">
<meta name="twitter:site" content="@twitch">
<meta name="twitter:image" content="https://static-cdn.jtvnw.net/s3_vods/tehsmileys/241633142/df7ddf3c-de65-4f3f-aa6f-a9f28bea306a/thumb/custom-a7904304-5d03-4c89-b481-5215f60730c8-640x360.jpg">
<meta name="twitter:player" content="http://player.twitch.tv/?video=241633142">
<meta name="twitter:player:width" content="640">
<meta name="twitter:player:height" content="360">
<meta name="twitter:image:partner_badge:src" content="https://clips-media-assets.twitch.tv/img/twitch-white-rgb.png"/>
```

### Clips - `clip`

*twitch_twitter-embed.php?clip=CuriousHappyDogeAMPEnergyCherry*

Uses Clip title, Clip game, Clip thumbnail, and Clip embed player.

```html
<meta property="twitter:title" content="Clip of TehSmileys playing Fortnite on Twitch!">
<meta property="twitter:description" content="Operation pancake porcupine. ">
<meta name="twitter:card" content="player">
<meta name="twitter:site" content="@twitch">
<meta name="twitter:image" content="https://clips-media-assets.twitch.tv/vod-244891732-offset-7788-preview-480x272.jpg">
<meta name="twitter:player" content="https://clips.twitch.tv/embed?clip=CuriousHappyDogeAMPEnergyCherry">
<meta name="twitter:player:width" content="640">
<meta name="twitter:player:height" content="360">
<meta name="twitter:image:partner_badge:src" content="https://clips-media-assets.twitch.tv/img/twitch-white-rgb.png"/>
```
