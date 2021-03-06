<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    xmlns:ddi-xslt="https://github.com/MetadataTransform/ddi-xslt"
	
    exclude-result-prefixes="xs ddi-xslt"
    version="1.0">
    <xsl:output method="xml" indent="yes" omit-xml-declaration="yes"/>

    <xsl:param name="defaultLang">en</xsl:param>
    <xsl:param name="country"/>

    <xsl:template match="/codeBook">
        <json>
            <!-- id -->
            <id>
                <xsl:choose>
                    <xsl:when test="@ID">
                        <xsl:value-of select="@ID"/>
                    </xsl:when>
                    <xsl:when test="stdyDscr/citation/titlStmt/IDNo">
                        <xsl:value-of select="stdyDscr/citation/titlStmt/IDNo/@agency"/>
                        <xsl:value-of select="stdyDscr/citation/titlStmt/IDNo"/>
                    </xsl:when>					
                </xsl:choose>
            </id>

            <!-- repository -->
            <repository>
                <xsl:choose>
                    <xsl:when test="stdyDscr/citation/distStmt/distrbtr/@abbr">
                        <xsl:value-of select="stdyDscr/citation/distStmt/distrbtr/@abbr"/>
                    </xsl:when>
                    <xsl:when test="docDscr/citation/titlStmt/IDNo/@agency">
                        <xsl:value-of select="docDscr/citation/titlStmt/IDNo/@agency"/>
                    </xsl:when>
                </xsl:choose>                
            </repository>

            <!-- title -->
            <xsl:for-each select="stdyDscr/citation/titlStmt/titl | stdyDscr/citation/titlStmt/parTitl">
                <title>
                    <xsl:call-template name="ddi-xslt:lang"/>
                </title>
            </xsl:for-each>
			
            <!-- abstract -->
            <xsl:for-each select="stdyDscr/stdyInfo/abstract">
                <abstract>
                    <xsl:call-template name="ddi-xslt:lang"/>
                </abstract>
            </xsl:for-each>			
			
            <!-- keyword -->
            <xsl:call-template name="ddi-xslt:multipleLangString">
                <xsl:with-param name="name">keyword</xsl:with-param>
                <xsl:with-param name="path"
                                select="stdyDscr/stdyInfo/subject/keyword"/>
            </xsl:call-template>
			
            <!-- subject -->
            <xsl:call-template name="ddi-xslt:multipleLangString">
                <xsl:with-param name="name">subject</xsl:with-param>
                <xsl:with-param name="path"
                                select="stdyDscr/stdyInfo/subject/topcClas"/>
            </xsl:call-template>			
			
            <!-- universe -->
            <xsl:call-template name="ddi-xslt:multipleLangString">
                <xsl:with-param name="name">universe</xsl:with-param>
                <xsl:with-param name="path" select="stdyDscr/stdyInfo/sumDscr/universe"/>
            </xsl:call-template>
			
            <!-- analysisunit -->
            <xsl:if test="stdyDscr/stdyInfo/sumDscr/anlyUnit/concept">
                <analysisunit>
                    <xsl:value-of select="stdyDscr/stdyInfo/sumDscr/anlyUnit/concept"/>
                </analysisunit>			
            </xsl:if>
			
            <!-- country -->
            <xsl:if test="stdyDscr/stdyInfo/sumDscr/nation">
                <country>
                    <xsl:value-of select="stdyDscr/stdyInfo/sumDscr/nation"/>
                </country>
            </xsl:if>
			
			
            <!-- startdate -->
            <xsl:if test="stdyDscr/stdyInfo/sumDscr/collDate[@event='start']">
                <startdate>
                    <xsl:value-of select="stdyDscr/stdyInfo/sumDscr/collDate[@event='start']/@date"/>
                </startdate>
            </xsl:if>
			
            <!-- enddate -->
            <xsl:if test="stdyDscr/stdyInfo/sumDscr/collDate[@event='end']">
                <enddate>
                    <xsl:value-of select="stdyDscr/stdyInfo/sumDscr/collDate[@event='end']/@date"/>
                </enddate>
            </xsl:if>			
						
            <!-- datakind -->
            <xsl:for-each select="stdyDscr/stdyInfo/sumDscr/dataKind">
                <datakind>
                    <xsl:call-template name="ddi-xslt:lang"/>
                </datakind>
            </xsl:for-each>
        </json>
    </xsl:template>

    <xsl:template name="ddi-xslt:multipleLangString">
        <xsl:param name="path"/>
        <xsl:param name="name"/>
        <xsl:for-each select="$path">
            <xsl:element name="{$name}">
                <xsl:call-template name="ddi-xslt:lang"/>
            </xsl:element>
        </xsl:for-each>
    </xsl:template>

    <xsl:template name="ddi-xslt:lang">
        <xsl:variable name="lang" select="./ancestor-or-self::*[attribute::xml:lang][1]/@xml:lang"/>
        <xsl:choose>
            <xsl:when test="$lang">
                <xsl:element name="{$lang}">
                    <xsl:call-template name="ddi-xslt:escapeQuote"/>
                </xsl:element>
            </xsl:when>
            <xsl:otherwise>
                <xsl:element name="{$defaultLang}">
                    <xsl:call-template name="ddi-xslt:escapeQuote"/>
                </xsl:element>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>

    <xsl:template name="ddi-xslt:escapeQuote">
        <xsl:param name="pText" select="normalize-space(.)"/>
        
        <xsl:if test="string-length($pText) >0">
            <xsl:value-of select=
                "substring-before(concat($pText, '&quot;'), '&quot;')"/>
            
            <xsl:if test="contains($pText, '&quot;')">
                <xsl:text>\"</xsl:text>
                
                <xsl:call-template name="ddi-xslt:escapeQuote">
                    <xsl:with-param name="pText" select=
                        "substring-after($pText, '&quot;')"/>
                </xsl:call-template>
            </xsl:if>
        </xsl:if>
    </xsl:template>
</xsl:stylesheet>
