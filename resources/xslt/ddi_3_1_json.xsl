<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:g="ddi:group:3_1"
                xmlns:d="ddi:datacollection:3_1" xmlns:dce="ddi:dcelements:3_1"
                xmlns:c="ddi:conceptualcomponent:3_1" xmlns:xhtml="http://www.w3.org/1999/xhtml"
                xmlns:a="ddi:archive:3_1" xmlns:m1="ddi:physicaldataproduct/ncube/normal:3_1"
                xmlns:ddi="ddi:instance:3_1" xmlns:m2="ddi:physicaldataproduct/ncube/tabular:3_1"
                xmlns:l="ddi:logicalproduct:3_1" xmlns:m3="ddi:physicaldataproduct/ncube/inline:3_1"
                xmlns:pd="ddi:physicaldataproduct:3_1" xmlns:cm="ddi:comparative:3_1"
                xmlns:s="ddi:studyunit:3_1" xmlns:r="ddi:reusable:3_1" xmlns:pi="ddi:physicalinstance:3_1"
                xmlns:ds="ddi:dataset:3_1" xmlns:pr="ddi:profile:3_1"
                xmlns:fn="http://www.w3.org/2005/xpath-functions"
                xmlns:ddi-xslt="https://github.com/MetadataTransform/ddi-xslt"
                exclude-result-prefixes="xs g d dce c a ddi m1 m2 m3 l pd cm s r pi ds pr xhtml fn ddi-xslt"
                version="1.0">
    <xsl:output method="xml" indent="yes" omit-xml-declaration="yes"/>

    <xsl:param name="defaultLang">en</xsl:param>
    <xsl:param name="country"/>

    <xsl:template match="/ddi:DDIInstance">
        <json>
            <!-- id -->
            <id>
                <xsl:choose>
                    <xsl:when test="//a:Archive/a:ArchiveSpecific/a:Collection/a:CallNumber">
                        <xsl:value-of
                            select="translate(//a:Archive/a:ArchiveSpecific/a:Collection/a:CallNumber, ' ', '')"
                        />
                    </xsl:when>
                    <xsl:otherwise>
                        <xsl:value-of select="s:StudyUnit/@id"/>
                        <xsl:text>:</xsl:text>
                        <xsl:value-of select="s:StudyUnit/@version"/>
                    </xsl:otherwise>
                </xsl:choose>
            </id>

            <!-- doi -->
            <xsl:if test="s:StudyUnit/r:Citation/r:InternationalIdentifier[@type='DOI']">
                <doi>
                    <xsl:value-of select="s:StudyUnit/r:Citation/r:InternationalIdentifier[@type='DOI']"/>
                </doi>
            </xsl:if>
            
            <!-- repository -->
            <repository>
                <xsl:value-of select="@agency"/>
            </repository>		
                        	
            <!-- title -->
            <xsl:call-template name="ddi-xslt:multipleLangString">
                <xsl:with-param name="name">title</xsl:with-param>
                <xsl:with-param name="path" select="s:StudyUnit/r:Citation/r:Title"/>
            </xsl:call-template>

            <!-- creator -->
            <xsl:call-template name="ddi-xslt:multipleLangString">
                <xsl:with-param name="name">creator</xsl:with-param>
                <xsl:with-param name="path" select="s:StudyUnit/r:Citation/r:Creator"/>
            </xsl:call-template>

            <!-- universe -->
            <xsl:call-template name="ddi-xslt:multipleLangString">
                <xsl:with-param name="name">universe</xsl:with-param>
                <xsl:with-param name="path" select="//c:UniverseName"/>
            </xsl:call-template>

            <!-- abstract -->
            <xsl:call-template name="ddi-xslt:multipleLangString">
                <xsl:with-param name="name">abstract</xsl:with-param>
                <xsl:with-param name="path" select="s:StudyUnit/s:Abstract/r:Content"/>
            </xsl:call-template>

            <!-- subject -->
            <xsl:call-template name="ddi-xslt:multipleLangString">
                <xsl:with-param name="name">subject</xsl:with-param>
                <xsl:with-param name="path"
                                select="s:StudyUnit/r:Coverage/r:TopicalCoverage/r:Subject"/>
            </xsl:call-template>

            <!-- keyword -->
            <xsl:call-template name="ddi-xslt:multipleLangString">
                <xsl:with-param name="name">keyword</xsl:with-param>
                <xsl:with-param name="path"
                                select="s:StudyUnit/r:Coverage/r:TopicalCoverage/r:Keyword"/>
            </xsl:call-template>

            <!-- modeofcollection -->
            <xsl:call-template name="ddi-xslt:multipleLangString">
                <xsl:with-param name="name">modeofcollection</xsl:with-param>
                <xsl:with-param name="path" select="//d:ModeOfCollection/r:Content"/>
            </xsl:call-template>

            <!-- timemethod -->
            <xsl:call-template name="ddi-xslt:multipleLangString">
                <xsl:with-param name="name">timemethod</xsl:with-param>
                <xsl:with-param name="path" select="//d:TimeMethod/r:Content"/>
            </xsl:call-template>

            <!-- kindofdata -->
            <xsl:for-each select="s:StudyUnit/s:KindOfData">
                <kindofdata>
                    <xsl:value-of select="."/>
                </kindofdata>
            </xsl:for-each>

            <!-- analysisunit -->
            <analysisunit>
                <xsl:for-each select="s:StudyUnit/r:AnalysisUnit">
                    <xsl:value-of select="."/>
                </xsl:for-each>
            </analysisunit>

            <!-- country -->
            <country>
                <xsl:choose>
                    <xsl:when
                        test="//r:GeographicLocation/r:Values/r:GeographyValue[r:GeographyCode/r:Value[@codeListID = 'ISO3166-1']]/r:GeographyName[@xml:lang = 'en']">
                        <xsl:value-of
                            select="//r:GeographicLocation/r:Values/r:GeographyValue[r:GeographyCode/r:Value[@codeListID = 'ISO3166-1']]/r:GeographyName[@xml:lang = 'en']"
                        />
                    </xsl:when>
                    <xsl:when test="@agency = 'dk.dda'">Denmark</xsl:when>
                    <xsl:otherwise>
                        <xsl:if test="$country">
                            <xsl:value-of select="$country"/>
                        </xsl:if>
                    </xsl:otherwise>
                </xsl:choose>
            </country>

            <!-- startdate -->
            <startdate>
                <xsl:if
                    test="s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:StartDate | s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:SimpleDate">
                
                    <xsl:choose>
                        <xsl:when
                            test="contains(s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:StartDate, 'T')">
                            <xsl:value-of
                                select="substring-before(s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:StartDate, 'T')"
                            />
                        </xsl:when>
                        <xsl:when
                            test="s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:SimpleDate">
                            <xsl:value-of
                                select="s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:SimpleDate"
                            />
                        </xsl:when>
                        <xsl:otherwise>
                            <xsl:value-of
                                select="s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:StartDate"
                            />
                        </xsl:otherwise>
                    </xsl:choose>
                
                </xsl:if>
            </startdate>

            <!-- enddate -->
            <enddate>
                <xsl:if
                    test="s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:EndDate | s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:SimpleDate">
                
                    <xsl:choose>
                        <xsl:when
                            test="contains(s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:EndDate, 'T')">
                            <xsl:value-of
                                select="substring-before(s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:EndDate, 'T')"
                            />
                        </xsl:when>
                        <xsl:when
                            test="s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:SimpleDate">
                            <xsl:value-of
                                select="s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:SimpleDate"
                            />
                        </xsl:when>
                        <xsl:otherwise>
                            <xsl:value-of
                                select="s:StudyUnit/r:Coverage/r:TemporalCoverage/r:ReferenceDate/r:EndDate"
                            />
                        </xsl:otherwise>
                    </xsl:choose>
                
                </xsl:if>
            </enddate>
            
            <!-- variable -->
            <xsl:apply-templates select="//l:Variable"/>
        </json>
    </xsl:template>

    <xsl:template match="l:Variable">
        <variable>
            <!-- id -->
            <id>
                <xsl:value-of select="@id"/>:<xsl:value-of select="@version"/>
            </id>
            
            <!-- label -->
            <xsl:call-template name="ddi-xslt:multipleLangString">
                <xsl:with-param name="name">label</xsl:with-param>
                <xsl:with-param name="path" select="r:Label"/>
            </xsl:call-template>

            <!-- concept -->
            <xsl:for-each select="l:ConceptReference">
                <xsl:variable name="cID" select="r:ID"/>
                <xsl:for-each select="//c:Concept[@id = $cID]">
                    <concept>
                        <!-- id -->
                        <id>
                            <xsl:value-of select="@id"/>:<xsl:value-of select="@version"/>
                        </id>
                        <!-- label -->
                        <xsl:call-template name="ddi-xslt:multipleLangString">
                            <xsl:with-param name="name">label</xsl:with-param>
                            <xsl:with-param name="path" select="r:Label"/>
                        </xsl:call-template>
                        <!-- description -->
                        <xsl:call-template name="ddi-xslt:multipleLangString">
                            <xsl:with-param name="name">description</xsl:with-param>
                            <xsl:with-param name="path" select="r:Description"/>
                        </xsl:call-template>
                    </concept>
                </xsl:for-each>
            </xsl:for-each>

            <!-- question -->
            <xsl:for-each select="l:QuestionReference">
                <xsl:variable name="qiID" select="r:ID"/>
                <xsl:for-each select="//d:QuestionItem[@id = $qiID]">
                    <question>                        
                        <!-- id -->
                        <id>
                            <xsl:value-of select="@id"/>:<xsl:value-of select="@version"/>
                        </id>                        
                        <!-- label -->
                        <xsl:for-each select="d:QuestionText">
                            <label>                                
                                <xsl:call-template name="ddi-xslt:lang">
                                    <xsl:with-param name="lang">.</xsl:with-param>
                                </xsl:call-template>
                            </label>
                        </xsl:for-each>                       
                    </question>
                </xsl:for-each>
            </xsl:for-each>

            <!-- representation -->
            <xsl:if test="l:Representation/l:TextRepresentation">
                <representation>TEXT</representation>
            </xsl:if>
            <xsl:if test="l:Representation/l:NumericRepresentation">
                <representation>NUMERIC</representation>
            </xsl:if>
            <xsl:if test="l:Representation/l:CodeRepresentation">
                <representation>CODE</representation>
                <xsl:variable name="csID"
                              select="l:Representation/l:CodeRepresentation/r:CodeSchemeReference/r:ID"/>
                <xsl:for-each select="//l:CodeScheme[@id = $csID]/l:Code/l:CategoryReference/r:ID">
                    <xsl:variable name="crID" select="."/>
                    <xsl:for-each select="//l:Category[@id = $crID]/r:Label">
                        <categories>
                            <xsl:call-template name="ddi-xslt:lang"/>
                        </categories>
                    </xsl:for-each>
                </xsl:for-each>
            </xsl:if>
        </variable>
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
