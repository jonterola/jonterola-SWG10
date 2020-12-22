<?xml version="1.0" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
    <html>
    <body>
        <table border='1'>
            <tr style="background-color:pink">
                <th>Autor</th>
                <th>Enunciado</th>
                <th>Respuesta Correcta</th>
                <th>Respuestas Incorrectas</th>
                <th>Tema</th>
            </tr>

            <xsl:for-each select="assessmentItems/assessmentItem">
                <tr style="background-color:#FBECF8">
                    <td><xsl:value-of select = "@author"/></td>
                    <td><xsl:value-of select = "itemBody"/></td>
                    <td><xsl:value-of select = "correctResponse/response"/></td>
                    <td><ul>
                    <xsl:for-each select="incorrectResponses/response">
                        <li><xsl:value-of select = "."/></li>
                    </xsl:for-each>
                    </ul></td>
                    <td><xsl:value-of select = "@subject"/></td>
                
                </tr>
            </xsl:for-each>
        </table> 
        </body>
        </html>   
    </xsl:template>
    </xsl:stylesheet>