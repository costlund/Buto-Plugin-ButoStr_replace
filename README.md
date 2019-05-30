# Buto-Plugin-ButoStr_replace

Page plugin to replace text.

## Settings

```
plugin_modules:
  str_replace:
    plugin: 'buto/str_replace'
```

## Url

```
/str_replace/form
```

## Usage

###Replace comma with "\n".

```
a,b,c
```
```
a
b
c
```

###Replace "\r\n" with comma.

```
a
b
c
```
```
a,b,c
```
