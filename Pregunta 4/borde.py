from PIL import Image, ImageFilter
tamaño = (5, 5)
coeficientes = [0,  0, -1,  0,  0,
                0, -1, -2, -1,  0,
               -1, -2, 16, -2, -1,
                0, -1, -2, -1,  0,
                0,  0, -1,  0,  0]

factor = 1
imagen_original = Image.open('imagen.jpg')
imagen_procesada = imagen_original.filter(ImageFilter.Kernel(tamaño, coeficientes, factor))
imagen_procesada.save('borde.jpg')
imagen_original.close()
imagen_procesada.close()